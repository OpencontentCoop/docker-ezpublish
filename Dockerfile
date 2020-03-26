FROM php:7.2.26-fpm-stretch
# Fixed version with OS Debian strech for the issue here explained
# https://github.com/docker-library/php/issues/865
#
# Container containing php-fpm and php-cli to run and interact with eZ Platform and other Symfony projects
#
# It has two modes of operation:
# - (run.sh cmd) [default] Reconfigure eZ Platform/Publish based on provided env variables and start php-fpm
# - (bash|php|composer) Allows to execute composer, php or bash against the image

# Set defaults for variables used by run.sh
ENV COMPOSER_HOME=/root/.composer

# Get packages that we need in container
RUN apt-get update -q -y \
    && apt-get install -q -y --no-install-recommends \
        ca-certificates \
        curl \
        acl \
        jq \
        sudo \
# Needed for the php extensions we enable below
        libfreetype6 \
        libjpeg62-turbo \
        libxpm4 \
        libpng16-16 \
        libpq-dev \
        libpq5 \
        libxslt1.1 \
        libmemcachedutil2 \
        imagemagick \
# git & unzip needed for composer, unless we document to use dev image for composer install
# unzip needed due to https://github.com/composer/composer/issues/4471
        unzip \
        git \
    && rm -rf /var/lib/apt/lists/*

# Install and configure php plugins
RUN set -xe \
    && buildDeps=" \
        $PHP_EXTRA_BUILD_DEPS \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libxpm-dev \
        libpng-dev \
        libicu-dev \
        libxslt1-dev \
        libmemcached-dev \
        libxml2-dev \
    " \
	&& apt-get update -q -y && apt-get install -q -y --no-install-recommends $buildDeps && rm -rf /var/lib/apt/lists/* \
# Extract php source and install missing extensions
    && docker-php-source extract \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/ --with-xpm-dir=/usr/include/ --enable-gd-jis-conv \
    && docker-php-ext-install exif gd mbstring intl xsl zip soap \
    && docker-php-ext-enable opcache \
    && cp /usr/src/php/php.ini-production ${PHP_INI_DIR}/php.ini \
    \
# Install blackfire: https://blackfire.io/docs/integrations/docker
#    && version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
#    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/linux/amd64/$version \
#    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp \
#    && mv /tmp/blackfire-*.so $(php -r "echo ini_get('extension_dir');")/blackfire.so \
#    && rm -f /tmp/blackfire-probe.tar.gz \
#    \
# Install igbinary (for more efficient serialization in redis/memcached)
    && for i in $(seq 1 3); do pecl install -o igbinary && s=0 && break || s=$? && sleep 1; done; (exit $s) \
    && docker-php-ext-enable igbinary \
    \
# Install redis (manualy build in order to be able to enable igbinary)
    && for i in $(seq 1 3); do pecl install -o --nobuild redis && s=0 && break || s=$? && sleep 1; done; (exit $s) \
    && cd "$(pecl config-get temp_dir)/redis" \
    && phpize \
    && ./configure --enable-redis-igbinary \
    && make \
    && make install \
    && docker-php-ext-enable redis \
    && cd - \
    \
# Install memcached (manualy build in order to be able to enable igbinary)
    && for i in $(seq 1 3); do echo no | pecl install -o --nobuild memcached && s=0 && break || s=$? && sleep 1; done; (exit $s) \
    && cd "$(pecl config-get temp_dir)/memcached" \
    && phpize \
    && ./configure --enable-memcached-igbinary \
    && make \
    && make install \
    && docker-php-ext-enable memcached \
    && cd - \
    \
# Install Postgres support
    #&& apt-get install --no-install-recommends -y libpq5=9.6.10-0+deb9u1 libpq-dev=9.6.10-0+deb9u1 \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    \
# Delete source & builds deps so it does not hang around in layers taking up space
    && pecl clear-cache \
    && rm -Rf "$(pecl config-get temp_dir)/*" \
    && docker-php-source delete \
    && apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false $buildDeps


# Set timezone
RUN echo "UTC" > /etc/timezone && dpkg-reconfigure --frontend noninteractive tzdata

# Set pid file to be able to restart php-fpm
RUN sed -i "s@^\[global\]@\[global\]\n\npid = /run/php-fpm.pid@" ${PHP_INI_DIR}-fpm.conf

# Create Composer directory (cache and auth files) & Get Composer
RUN mkdir -p $COMPOSER_HOME \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add some custom config
COPY conf.d/php.ini ${PHP_INI_DIR}/conf.d/php.ini

# Add entrypoint script
COPY scripts /scripts
RUN chmod 755 /scripts/*.sh

# Needed for docker-machine
# RUN usermod -u 1000 www-data

WORKDIR /var/www

COPY composer.json composer.lock /var/www/

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN echo "Running composer"  \
	&& composer global require hirak/prestissimo \
	&& composer install --prefer-dist --no-scripts --no-dev \ 
	&& rm -rf /root/.composer 
	
# Add consul client to allow configuration using consul KV store
COPY --from=consul:1.7 /bin/consul /bin/consul

# Add wait-for-it utility to check services readiness
RUN curl https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh > /bin/wait-for-it && \
    chmod +x /bin/wait-for-it

# Add custom settings of prototipo
COPY conf.d/ez /var/www/html/settings

WORKDIR /var/www/html

RUN php bin/php/ezcache.php --clear-id=global_ini --allow-root-user \
    && php bin/php/ezpgenerateautoloads.php -e 

WORKDIR /var/www

ENTRYPOINT ["/scripts/docker-entrypoint.sh"]

CMD php-fpm

EXPOSE 9000


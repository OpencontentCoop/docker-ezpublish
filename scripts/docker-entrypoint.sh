#!/usr/bin/env bash

[[ -n $DEBUG ]] && set -ex

# See:
# - Doc: https://docs.docker.com/engine/reference/builder/#entrypoint
# - Example: https://github.com/docker-library/mariadb/blob/master/10.1/docker-entrypoint.sh
#
# Example use:
# ./docker-entrypoint.sh php-fpm

if [[ -z $EZ_ROOT ]]; then
    echo "[error] EZ_ROOT is empty this variable is required in this container, please set it to the public dir of Ez and restart"
    exit 1
else
    echo "[info] Current root is ${EZ_ROOT}"
fi

EZ_INSTANCE=${EZ_INSTANCE:-''}
# If a variable specifing a specific instances exists we apply our bootstrap changes to that instance
# otherwise the changes are applied to all instances
if [[ -n $EZ_INSTANCE ]]; then
    EZ_INSTANCES="$EZ_INSTANCE"
else
    EZ_INSTANCES=$(grep 'AvailableSiteAccessList\[\]' ${EZ_ROOT}/settings/override/site.ini.append.php | cut -d= -f2 | grep backend)
fi

if [[ -n $EZ_INSTANCES ]]; then
    echo "[info] Current instance(s): ${EZ_INSTANCES}"
else
    echo "[info] No ez instances found"
fi


# Check availability of Postgres
pg_server=${EZINI_site__DatabaseSettings__Server:-postgres}
pg_port=${EZINI_site__DatabaseSettings__Port:-5432}
wait-for-it $pg_server:$pg_port --timeout=0 --strict -- echo "Postgres server @ ${pg_server}:${pg_port} is UP"

# Check availability of Solr
if [[ -n $EZINI_solr__SolrBase__SearchServerURI ]]; then
  if [[ $EZINI_solr__SolrBase__SearchServerURI =~ ^http://([^:]+):([0-9]+).* ]]; then
    solr_host=${BASH_REMATCH[1]} 
    solr_port=${BASH_REMATCH[2]}
    wait-for-it $solr_host:$solr_port --timeout=0 --strict -- echo "Solr server @ $solr_host:$solr_port is UP"
  fi
fi


## Clear container on start by default
if [ "$NO_FORCE_CONTAINER_REFRESH" != "" ]; then
    echo "[info] NO_FORCE_CONTAINER_REFRESH set, skipping container clearing on startup."
else
    echo "[info] NO_FORCE_CONTAINER_REFRESH is not set, clearing container..."
    # get a list of possible VarDir from ini settings
    varDirs=$(egrep '^VarDir=' ${EZ_ROOT}/settings/* -R | cut -d'=' -f2 | sort| uniq)
    for varDir in $varDirs; do
        if [[ -d ${EZ_ROOT}/${varDir} ]]; then
            echo "[info] cleaning VarDir '${EZ_ROOT}/${varDir}' ..."
            chown www-data ${EZ_ROOT}/${varDir} -R
        else
            echo "[warn] no VarDir found"
        fi
    done

    if [[ -n $EZ_INSTANCES ]]; then
        for EZ_INSTANCE in $EZ_INSTANCES; do
            echo "[info] cleaning DFS for instance ${EZ_INSTANCE} with php bin/php/ezcache.php --clear-all -s${EZ_INSTANCE} --allow-root-user"
            php bin/php/ezcache.php --clear-all -s${EZ_INSTANCE} --allow-root-user
        done
    fi

    dfsDirs=$(egrep '^MountPointPath=.+' ${EZ_ROOT}/settings/* -R | cut -d'=' -f2 | sort| uniq)
    for dfsDir in $dfsDirs; do
        if [[ -d ${dfsDir} ]]; then
            echo "[info] fixing perms in '${dfsDir}' ..."
            chown www-data ${dfsDir} 
        else
            echo "[info] no VarDir found"
        fi
    done
    
    # Be sure that permission of configured var are correct
    if [[ -n $EZINI_site__FileSettings__VarDir ]]; then
      echo "[info] Setting owner www-data in ${EZINI_site__FileSettings__VarDir}"
      [[ ! -d $EZINI_site__FileSettings__VarDir ]] && \
    	mkdir -p $EZINI_site__FileSettings__VarDir
        chown www-data $EZINI_site__FileSettings__VarDir
    fi

    # look for remaining files owned by root
    if [[ -d var ]]; then 
	echo "[info] looking for residual files owned by root"
	find var -user root -exec chown www-data {} \;
    fi

fi


## Adjust behat.yml if asked for from localhost setup to use defined hosts
if [ "$BEHAT_SELENIUM_HOST" != "" ] && [ "$BEHAT_WEB_HOST" != "" ]; then
    logger "Copying behat.yml.dist to behat.yml and updating selenium and web hosts"
    if [ -f behat.yml.dist ]; then
        cp -f behat.yml.dist behat.yml
        sed -i "s@localhost:4444@${BEHAT_SELENIUM_HOST}:4444@" behat.yml
        sed -i "s@localhost@${BEHAT_WEB_HOST}@" behat.yml
    else
        logger "No behat.yml.dist found, skipping"
    fi
fi


## Auto adjust log folder for xdebug if enabled
if [ ! -d app ] && [ -f ${PHP_INI_DIR}/conf.d/xdebug.ini ]; then
    if [ -d ezpublish/log ]; then
        logger "Auto adjusting xdebug settings to log in ezpublish/log"
        sed -i "s@/var/www/app/log@/var/www/ezpublish/log@" ${PHP_INI_DIR}/conf.d/xdebug.ini
    elif [ -d var/log ]; then
        logger "Auto adjusting xdebug settings to log in var/log"
        sed -i "s@/var/www/app/log@/var/www/var/log@" ${PHP_INI_DIR}/conf.d/xdebug.ini
    fi
fi

# docker-entrypoint-initdb.d, as provided by most official images allows for direct usage and extended images to
# extend behaviour without modifying this file.
for f in /docker-entrypoint-initdb.d/*; do
    case "$f" in
        *.sh)     logger "$0: running $f"; . "$f" ;;
        "/docker-entrypoint-initdb.d/*") ;;
        *)        logger "$0: ignoring $f" ;;
    esac
done

# Scan for environment variables prefixed with PHP_INI_ENV_ and inject those into ${PHP_INI_DIR}/conf.d/zzz_custom_settings.ini
if [ -f ${PHP_INI_DIR}/conf.d/zzz_custom_settings.ini ]; then rm ${PHP_INI_DIR}/conf.d/zzz_custom_settings.ini; fi
env | while IFS='=' read -r name value ; do
  if (echo $name|grep -E "^PHP_INI_ENV">/dev/null); then
    # remove PHP_INI_ENV_ prefix
    name=`echo $name | cut -f 4- -d "_"`
    echo $name=$value >> ${PHP_INI_DIR}/conf.d/zzz_custom_settings.ini
  fi
done


# FIXME: Export logs in stdout
# very bad way to export logs... probably we need to fix it in ezpublish
# kernel
for logfile in cluster_error debug error ocfoshttpcache storage warning mugo_varnish_purges; do
  # a link doesn't do the trick, because php-fpm does not run under root user
  #  ln -sf /dev/stdout /var/www/html/var/log/${logfile}.log
  if [[ ! -f $logfile ]]; then
    touch ${EZ_ROOT}/var/log/${logfile}.log && \
    chown www-data ${EZ_ROOT}/var/log/${logfile}.log
  fi
  
  # send to background
  tail -F --pid $$ ${EZ_ROOT}/var/log/${logfile}.log &
  
done

if [[ -n $CONSUL_PREFIX ]]; then
  wait-for-it ${CONSUL_HTTP_ADDR:-consul:8500} --timeout=300 -- consul watch \
	-type=keyprefix \
	-prefix=${CONSUL_PREFIX} \
	/scripts/consul2files.sh ${CONSUL_PREFIX} /var/www/html/settings 
fi

exec "$@"

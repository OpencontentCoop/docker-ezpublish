#!/bin/bash
set -ex
if [[ -n $EZ_INSTANCE ]]; then
  echo "==> Changing ez instance variable in ${EZ_INSTANCE} ..."
  sed -i "s/prototipo/${EZ_INSTANCE}/" /etc/nginx/conf.d/default.conf 
fi

if [[ -z PROMETHEUS_DISABLE ]]; then
  echo "==> Starting prometheus metrics exporter"
  /usr/bin/exporter -nginx.scrape-uri http://localhost:80/nginx_status &
fi

echo "==> Starting nginx... good luck!"
exec nginx -g 'daemon off;'


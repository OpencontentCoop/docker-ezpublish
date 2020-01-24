#!/bin/bash
set -ex
if [[ -n $EZ_INSTANCE ]]; then
  echo "==> Changing ez instance variable in ${EZ_INSTANCE} ..."
  sed -i "s/prototipo/${EZ_INSTANCE}/" /etc/nginx/conf.d/default.conf 
fi

echo "==> Starting nginx... good luck!"
exec nginx -g 'daemon off;'


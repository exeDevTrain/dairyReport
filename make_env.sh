#!/bin/bash
set -eu

cat << EOT > .env
#ホストのUID GID
GROUP_ID=`id -g`
GROUP_NAME=hoge
USER_ID=`id -u`
USER_NAME=hoge
#PHPの設定
WEB_PORT=28000
DB_PORT=3306
DB_NAME=php_local
DB_USER=phper
DB_PASS=secret
EOT
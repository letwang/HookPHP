#!/bin/sh
mysqld &
mongod --bind_ip_all &
redis-server /etc/redis/redis.conf &
rarabbitmq-server &
service php7.3-fpm start
service nginx start
cd /usr/share/nginx/html/HookPHP/
chmod 777 -R docker/log
chmod 777 -R log
composer install
PATH=/usr/local/openresty/nginx/sbin:$PATH
export PATH
nginx -p openresty/ -c conf/nginx.conf
if [ ! -f "vendor/Hook/Tika/tika-app-1.22.jar" ];then
    wget -P vendor/Hook/Tika http://mirrors.tuna.tsinghua.edu.cn/apache/tika/tika-app-1.22.jar
fi
sleep 5
php app/admin/bin/install.php
php app/iot/bin/install.php
php app/paas/bin/install.php
php app/payment/bin/install.php
php app/store/bin/install.php
pwd
zsh

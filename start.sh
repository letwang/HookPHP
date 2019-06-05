#!/bin/sh
mysqld &
mongod &
redis-server &
service php7.3-fpm start
service nginx start
chmod 777 -R /usr/share/nginx/html/HookPHP/docker/log
chmod 777 -R /usr/share/nginx/html/HookPHP/log
chmod 777 -R /usr/share/nginx/html/HookPHP/conf
zsh
ps -ef
/bin/bash
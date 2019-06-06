#!/bin/sh
mysqld &
mongod &
redis-server &
service php7.3-fpm start
service nginx start
cd /usr/share/nginx/html/HookPHP/ &&
chmod 777 -R docker/log &&
chmod 777 -R log &&
chmod 777 -R conf &&
composer install &&
wget -P vendor/Hook/Tika http://mirrors.tuna.tsinghua.edu.cn/apache/tika/tika-app-1.21.jar &&
php app/admin/bin/install.php &&
php app/iot/bin/install.php &&
php app/paas/bin/install.php &&
php app/payment/bin/install.php &&
php app/store/bin/install.php &&
bin/bash
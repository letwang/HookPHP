#!/bin/sh
tee /etc/apt/sources.list <<EOF
deb http://mirrors.aliyun.com/ubuntu/ focal main restricted
deb http://mirrors.aliyun.com/ubuntu/ focal-updates main restricted

deb http://mirrors.aliyun.com/ubuntu/ focal universe
deb http://mirrors.aliyun.com/ubuntu/ focal-updates universe

deb http://mirrors.aliyun.com/ubuntu/ focal multiverse
deb http://mirrors.aliyun.com/ubuntu/ focal-updates multiverse

deb http://mirrors.aliyun.com/ubuntu/ focal-backports main restricted universe multiverse
deb http://mirrors.aliyun.com/ubuntu/ focal-security main restricted

deb http://mirrors.aliyun.com/ubuntu/ focal-security universe
deb http://mirrors.aliyun.com/ubuntu/ focal-security multiverse
EOF

apt-get update -y &&
apt-get upgrade -y &&
apt-get install -y sudo vim git pip zsh curl wget zip htop cmake gnupg lsb-release ca-certificates apt-transport-https software-properties-common libzstd-dev libcurl4-openssl-dev libgraphviz-dev

add-apt-repository -y ppa:ondrej/php
add-apt-repository -y ppa:redislabs/redis
add-apt-repository -y ppa:rabbitmq/rabbitmq-erlang

curl -s https://packagecloud.io/install/repositories/rabbitmq/rabbitmq-server/script.deb.sh | bash

wget -O - https://openresty.org/package/pubkey.gpg | apt-key add - &&
echo "deb http://openresty.org/package/ubuntu $(lsb_release -sc) main" > /etc/apt/sources.list.d/openresty.list

wget https://dev.mysql.com/get/mysql-apt-config_0.8.22-1_all.deb &&
dpkg -i mysql-apt-config_0.8.22-1_all.deb &&
rm mysql-apt-config_0.8.22-1_all.deb

wget -qO - https://www.mongodb.org/static/pgp/server-5.0.asc | apt-key add - &&
echo "deb [ arch=amd64,arm64 ] https://repo.mongodb.org/apt/ubuntu focal/mongodb-org/5.0 multiverse" | tee /etc/apt/sources.list.d/mongodb-org-5.0.list

apt-get update -y

apt-get install -y erlang-base erlang-asn1 erlang-crypto erlang-eldap erlang-ftp erlang-inets erlang-mnesia erlang-os-mon erlang-parsetools erlang-public-key erlang-runtime-tools erlang-snmp erlang-ssl erlang-syntax-tools erlang-tftp erlang-tools erlang-xmerl rabbitmq-server
apt-get install -y php8.1-common php8.1-cli php8.1-bcmath php8.1-dev php8.1-xml php8.1-opcache php8.1-mbstring php8.1-mysql php8.1-fpm php8.1-gd php8.1-zip php8.1-curl php8.1-int
apt-get install -y "openresty*" mysql-server redis mongodb-org

apt-get install -y nodejs
apt-get install -y npm
npm install -g n
npm install -g yarn
n latest

pear install PHP_CodeSniffer

pip config set global.index-url https://mirrors.aliyun.com/pypi/simple &&
pip config set global.trusted-host mirrors.aliyun.com &&
pip install supervisor &&
echo_supervisord_conf > /etc/supervisord.conf &&
sed -i 's/;\[inet_http_server]/\[inet_http_server]/' /etc/supervisord.conf &&
sed -i 's/;port=127.0.0.1/port=*/' /etc/supervisord.conf &&
sed -i 's/;\[include]/\[include]/' /etc/supervisord.conf &&
sed -i 's#;files = relative/directory/\*\.ini#files = /etc/supervisor/conf.d/*.conf#' /etc/supervisord.conf &&
mkdir -vp /etc/supervisor/conf.d/

wget https://github.com/alanxz/rabbitmq-c/archive/refs/tags/v0.11.0.zip &&
unzip v0.11.0.zip &&
rm v0.11.0.zip &&
cd rabbitmq-c-0.11.0 &&
mkdir build &&
cd build &&
cmake .. &&
cmake --build . &&
cmake -DCMAKE_INSTALL_PREFIX=/usr/local .. &&
cmake --build . --target install &&
rm -rf /rabbitmq-c-0.11.0/

pecl channel-update pecl.php.net

pecl install msgpack
pecl install igbinary
pecl install lzf
pecl install zstd
pecl install amqp
pecl install yaf
pecl install apcu
pecl install mongodb
pecl install seaslog
pecl install xhprof
pecl install redis

tee /etc/supervisor/conf.d/hookphp.conf <<EOF
[program:hookphp]
command=/bin/cat
process_name=%(program_name)s%(process_num)s
numprocs=4
startretries=10

redirect_stderr=true

stdout_syslog=true
stderr_syslog=true
EOF

mkdir /var/log/xhprof &&
mkdir /etc/openresty/conf.d &&
cd /usr/local/openresty/nginx/html &&
rm *.html &&
echo "<?php phpinfo();?>" > phpinfo.php

tee -a /etc/hosts <<EOF

127.0.0.1 www.admin.com
127.0.0.1 www.iot.com
127.0.0.1 www.paas.com
127.0.0.1 www.payment.com
127.0.0.1 www.store.com
EOF

openssl genrsa -out /etc/openresty/privkey.pem
openssl req -new -x509 -key /etc/openresty/privkey.pem -out /etc/openresty/server.pem -days 3650

tee /etc/openresty/nginx.conf <<EOF
user www-data;
worker_processes 1;

error_log logs/error.log;

events {
    worker_connections  1024;
}

http {
    include       mime.types;
    default_type  application/octet-stream;

    log_format  main  '\$request_id - \$remote_addr - \$remote_user [\$time_local] "\$request" '
                      '\$status \$body_bytes_sent "\$http_referer" '
                      '"\$http_user_agent" "\$http_x_forwarded_for"';
    access_log  logs/access.log main;

    sendfile        on;
    keepalive_timeout  65;

    gzip  on;

    server {
        root    html;
        listen  80 ssl http2;
        charset utf-8;

        index index.html index.htm index.php;

        autoindex on;
        autoindex_exact_size off;
        autoindex_localtime on;

        server_name  localhost;

        ssl_certificate      server.pem;
        ssl_certificate_key  privkey.pem;

        ssl_session_cache    shared:SSL:1m;
        ssl_session_timeout  5m;

        ssl_ciphers  HIGH:!aNULL:!MD5;
        ssl_prefer_server_ciphers  on;
        
        location ~ \.php$ {
            add_header request-id \$request_id;

            fastcgi_pass   unix:/run/php/php8.1-fpm.sock;
            fastcgi_param  REQUEST_ID \$request_id;
            fastcgi_param  SCRIPT_FILENAME  \$document_root\$fastcgi_script_name;
            include        fastcgi_params;
        }
    }

    include conf.d/*.conf;
}
EOF

tee /etc/openresty/conf.d/hookphp.conf <<EOF
server {
    listen  80 ssl http2;
    root html/HookPHP/public/admin/;
    index index.php;
    error_log logs/www.admin.com-error.log;
    access_log logs/www.admin.com-access.log main;
    server_name www.admin.com;

    if (!-e \$request_filename) {
        rewrite ^/(.*)  /index.php?\$1 last;
    }

    ssl_certificate      server.pem;
    ssl_certificate_key  privkey.pem;

    ssl_session_cache    shared:SSL:1m;
    ssl_session_timeout  5m;

    ssl_ciphers  HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers  on;

    location ~ \.(js|css|gif|jpg|jpeg|png|ico)$
    {
        expires 1d;
    }

    location ~ \.php$ {
        add_header request-id \$request_id;

        fastcgi_pass   unix:/run/php/php8.1-fpm.sock;
        fastcgi_param  REQUEST_ID \$request_id;
        fastcgi_param  SCRIPT_FILENAME  \$document_root\$fastcgi_script_name;
        include        fastcgi_params;
    }
}

server {
    listen  80 ssl http2;
    root html/HookPHP/public/iot/;
    index index.php;
    error_log logs/www.iot.com-error.log;
    access_log logs/www.iot.com-access.log main;
    server_name www.iot.com;

    if (!-e \$request_filename) {
        rewrite ^/(.*)  /index.php?\$1 last;
    }

    ssl_certificate      server.pem;
    ssl_certificate_key  privkey.pem;

    ssl_session_cache    shared:SSL:1m;
    ssl_session_timeout  5m;

    ssl_ciphers  HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers  on;

    location ~ \.(js|css|gif|jpg|jpeg|png|ico)$
    {
        expires 1d;
    }

    location ~ \.php$ {
        add_header request-id \$request_id;

        fastcgi_pass   unix:/run/php/php8.1-fpm.sock;
        fastcgi_param  REQUEST_ID \$request_id;
        fastcgi_param  SCRIPT_FILENAME  \$document_root\$fastcgi_script_name;
        include        fastcgi_params;
    }
}

server {
    listen  80 ssl http2;
    root html/HookPHP/public/paas/;
    index index.php;
    error_log logs/www.paas.com-error.log;
    access_log logs/www.paas.com-access.log main;
    server_name www.paas.com;

    if (!-e \$request_filename) {
        rewrite ^/(.*)  /index.php?\$1 last;
    }

    ssl_certificate      server.pem;
    ssl_certificate_key  privkey.pem;

    ssl_session_cache    shared:SSL:1m;
    ssl_session_timeout  5m;

    ssl_ciphers  HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers  on;

    location ~ \.(js|css|gif|jpg|jpeg|png|ico)$
    {
        expires 1d;
    }

    location ~ \.php$ {
        add_header request-id \$request_id;

        fastcgi_pass   unix:/run/php/php8.1-fpm.sock;
        fastcgi_param  REQUEST_ID \$request_id;
        fastcgi_param  SCRIPT_FILENAME  \$document_root\$fastcgi_script_name;
        include        fastcgi_params;
    }
}

server {
    listen  80 ssl http2;
    root html/HookPHP/public/payment/;
    index index.php;
    error_log logs/www.payment.com-error.log;
    access_log logs/www.payment.com-access.log main;
    server_name www.payment.com;

    if (!-e \$request_filename) {
        rewrite ^/(.*)  /index.php?\$1 last;
    }

    ssl_certificate      server.pem;
    ssl_certificate_key  privkey.pem;

    ssl_session_cache    shared:SSL:1m;
    ssl_session_timeout  5m;

    ssl_ciphers  HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers  on;

    location ~ \.(js|css|gif|jpg|jpeg|png|ico)$
    {
        expires 1d;
    }

    location ~ \.php$ {
        add_header request-id \$request_id;

        fastcgi_pass   unix:/run/php/php8.1-fpm.sock;
        fastcgi_param  REQUEST_ID \$request_id;
        fastcgi_param  SCRIPT_FILENAME  \$document_root\$fastcgi_script_name;
        include        fastcgi_params;
    }
}

server {
    listen  80 ssl http2;
    root html/HookPHP/public/store/;
    index index.php;
    error_log logs/www.store.com-error.log;
    access_log logs/www.store.com-access.log main;
    server_name www.store.com;

    if (!-e \$request_filename) {
        rewrite ^/(.*)  /index.php?\$1 last;
    }

    ssl_certificate      server.pem;
    ssl_certificate_key  privkey.pem;

    ssl_session_cache    shared:SSL:1m;
    ssl_session_timeout  5m;

    ssl_ciphers  HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers  on;

    location ~ \.(js|css|gif|jpg|jpeg|png|ico)$
    {
        expires 1d;
    }

    location ~ \.php$ {
        add_header request-id \$request_id;

        fastcgi_pass   unix:/run/php/php8.1-fpm.sock;
        fastcgi_param  REQUEST_ID \$request_id;
        fastcgi_param  SCRIPT_FILENAME  \$document_root\$fastcgi_script_name;
        include        fastcgi_params;
    }
}
EOF

tee -a /etc/php/8.1/mods-available/opcache.ini <<EOF

opcache.enable=1

opcache.jit_buffer_size=512M

opcache.preload=/usr/local/openresty/nginx/html/HookPHP/preload.php
opcache.preload_user=root
EOF

sed -i 's/display_errors = Off/display_errors = On/' /etc/php/8.1/fpm/php.ini &&
tee -a /etc/php/8.1/fpm/php.ini <<EOF
[Session]
session.save_handler=redis
session.serialize_handler=igbinary
session.save_path="tcp://127.0.0.1:6379?weight=1&auth=123456&database=0, tcp://127.0.0.1:6379?weight=2&auth=123456&database=0"

[msgpack]
extension=msgpack

[igbinary]
extension=igbinary

[lzf]
extension=lzf

[zstd]
extension=zstd

[yaf]
extension=yaf
yaf.environ=product
yaf.cache_config=1
yaf.use_namespace=1
yaf.use_spl_autoload=1
yaf.library=/usr/local/openresty/nginx/html/HookPHP/vendor/

[apcu]
extension=apcu
apc.enabled=1
apc.enable_cli=1

[seaslog]
extension=seaslog
seaslog.trace_exception=1
seaslog.trace_notice=1
seaslog.trace_warning=1
seaslog.default_basepath='/usr/local/openresty/nginx/html/HookPHP/log'
seaslog.default_template='%T | %L | %P | %Q | %t | %M | %H | %D | %R | %m | %I | %F | %U | %u | %C'

[xhprof]
extension=xhprof
xhprof.output_dir='/var/log/xhprof'

[amqp]
extension=amqp
amqp.login=admin
amqp.password=123456

[redis]
extension=redis

[mongodb]
extension=mongodb

EOF

sed -i 's/display_errors = Off/display_errors = On/' /etc/php/8.1/cli/php.ini &&
tee -a /etc/php/8.1/cli/php.ini <<EOF
[Session]
session.save_handler=redis
session.serialize_handler=igbinary
session.save_path="tcp://127.0.0.1:6379?weight=1&auth=123456&database=0, tcp://127.0.0.1:6379?weight=2&auth=123456&database=0"

[msgpack]
extension=msgpack

[igbinary]
extension=igbinary

[lzf]
extension=lzf

[zstd]
extension=zstd

[yaf]
extension=yaf
yaf.environ=product
yaf.cache_config=1
yaf.use_namespace=1
yaf.use_spl_autoload=1
yaf.library=/usr/local/openresty/nginx/html/HookPHP/vendor/

[apcu]
extension=apcu
apc.enabled=1
apc.enable_cli=1

[seaslog]
extension=seaslog
seaslog.trace_exception=1
seaslog.trace_notice=1
seaslog.trace_warning=1
seaslog.default_basepath='/usr/local/openresty/nginx/html/HookPHP/log'
seaslog.default_template='%T | %L | %P | %Q | %t | %M | %H | %D | %R | %m | %I | %F | %U | %u | %C'

[xhprof]
extension=xhprof
xhprof.output_dir='/var/log/xhprof'

[amqp]
extension=amqp
amqp.login=admin
amqp.password=123456

[redis]
extension=redis

[mongodb]
extension=mongodb

EOF

tee /etc/vim/vimrc <<EOF
set fileencodings=utf-8,gb2312,gbk,gb18030
set termencoding=utf-8
set encoding=prc
EOF

sed -i 's/# requirepass foobared/requirepass 123456/' /etc/redis/redis.conf

service openresty start
service php8.1-fpm start
service redis-server start
service rabbitmq-server start

rabbitmq-plugins enable rabbitmq_management rabbitmq_shovel rabbitmq_shovel_management &&
rabbitmqctl add_user admin 123456 &&
rabbitmqctl set_user_tags admin administrator &&
rabbitmqctl set_permissions -p / admin '.*' '.*' '.*' &&
rabbitmqctl delete_user guest

mysqld --user=root &
mongod -f /etc/mongod.conf &

supervisord -c /etc/supervisord.conf

curl -sS https://install.phpcomposer.com/installer | php &&
mv composer.phar /usr/local/bin/composer &&
composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/

wget https://www.phpmyadmin.net/downloads/phpMyAdmin-latest-all-languages.zip -O phpMyAdmin.zip &&
unzip phpMyAdmin.zip &&
rm phpMyAdmin.zip &&
mv  phpMyAdmin*/ phpMyAdmin/ &&
mkdir phpMyAdmin/tmp &&
chmod 777 phpMyAdmin/tmp &&
sed -i "s/\$cfg\['AllowArbitraryServer'] = false/\$cfg\['AllowArbitraryServer'] = true/" phpMyAdmin/libraries/config.default.php &&

git clone https://gitee.com/mirrors/phpredisadmin.git phpRedisAdmin &&
cd phpRedisAdmin &&
sed -i "s#//'auth' => 'redispasswordhere'#'auth' => '123456'#" includes/config.sample.inc.php &&
git clone https://gitee.com/mirrors/predis.git vendor &&
cd ../

mysql -uroot -p123456 -e 'CREATE DATABASE `hookphp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;SET GLOBAL AUTOCOMMIT=0'

cd HookPHP
chmod 777 -R log
composer install
php app/admin/bin/install.php
php app/iot/bin/install.php
php app/paas/bin/install.php
php app/payment/bin/install.php
php app/store/bin/install.php

git clone https://gitee.com/mirrors/oh-my-zsh.git ~/.oh-my-zsh &&
cp ~/.oh-my-zsh/templates/zshrc.zsh-template ~/.zshrc &&
apt-get clean &&
apt-get autoclean &&
zsh &&
pwd &&
ll

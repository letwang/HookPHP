# Introduction
https://my.oschina.net/cart/blog/2986804
# Environment
```
curl -L https://packagecloud.io/varnishcache/varnish62/gpgkey | sudo apt-key add -
echo "deb https://packagecloud.io/varnishcache/varnish62/ubuntu/ bionic main\ndeb-src https://packagecloud.io/varnishcache/varnish62/ubuntu bionic main" | sudo tee /etc/apt/sources.list.d/varnishcache_varnish62.list

sudo apt-get update

sudo apt-get install php7.3-common php7.3-cli php7.3-bcmath php7.3-dev php7.3-xml php7.3-opcache php7.3-mbstring php7.3-mysql php7.3-fpm php7.3-gd php7.3-zip php7.3-curl php7.3-intl php7.3-json graphviz-dev libvarnishapi1 libvarnishapi-dev erlang-nox
sudo apt-get install varnish

sudo pecl uninstall yaf && sudo pecl install yaf

git clone https://github.com/laruence/yac.git
cd yac && phpize7.3 && ./configure --with-php-config=php-config7.3
sudo make && sudo make install

git clone https://github.com/laruence/yaconf.git
cd yaconf && phpize7.3 && ./configure --with-php-config=php-config7.3
sudo make && sudo make install

sudo pecl uninstall seaslog && sudo pecl install seaslog

git clone https://github.com/longxinH/xhprof.git
cd xhprof/extension/ && phpize7.3 && ./configure --with-php-config=php-config7.3
sudo make && sudo make install

git clone https://github.com/cataphract/php-rar.git
cd php-rar && phpize7.3 &&./configure --with-php-config=php-config7.3
sudo make && sudo make install

sudo pecl uninstall msgpack && sudo pecl install msgpack
sudo pecl uninstall igbinary && sudo pecl install igbinary

wget https://github.com/alanxz/rabbitmq-c/archive/v0.9.0.zip
unzip v0.9.0.zip && cd rabbitmq-c-0.9.0
mkdir build && cd build && cmake .. && cmake --build . && cmake -DCMAKE_INSTALL_PREFIX=/usr/local .. && cmake --build . --target install
sudo pecl uninstall amqp && sudo pecl install amqp

sudo pecl uninstall varnish && sudo pecl install varnish

sudo pecl uninstall redis && sudo pecl install redis
sudo pecl uninstall mongodb && sudo pecl install mongodb
sudo pecl uninstall swoole && sudo pecl install swoole

wget https://github.com/sysown/proxysql/releases/download/v2.0.3/proxysql_2.0.3-ubuntu18_amd64.deb
sudo dpkg -i proxysql_2.0.3-ubuntu18_amd64.deb

wget https://dl.bintray.com/rabbitmq/all/rabbitmq-server/3.7.14/rabbitmq-server_3.7.14-1_all.deb
sudo dpkg -i rabbitmq-server_3.7.14-1_all.deb
sudo rabbitmq-server start
sudo rabbitmqctl status
sudo rabbitmq-plugins enable rabbitmq_management rabbitmq_shovel rabbitmq_shovel_management

curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

wget -P ~/bin/ http://sphinxsearch.com/files/sphinx-3.1.1-612d99f-linux-amd64.tar.gz
wget -P /home/letwang/workspace/HookPHP/vendor/Hook/Tika http://mirrors.hust.edu.cn/apache/tika/tika-app-1.20.jar
```
# php.ini
```
[Session]
session.save_handler = redis
session.serialize_handler = igbinary
session.save_path = "tcp://127.0.0.1:6379?weight=1&auth=123456&database=0, tcp://127.0.0.1:6379?weight=2&auth=123456&database=0"

[yaf]
extension=yaf
yaf.use_namespace = 1
yaf.use_spl_autoload = 1
yaf.library = /home/letwang/workspace/HookPHP/vendor/

[yac]
extension=yac

[yaconf]
extension=yaconf
yaconf.directory = /home/letwang/workspace/HookPHP/conf/

[seaslog]
extension=seaslog
seaslog.trace_notice=1
seaslog.trace_warning=1
seaslog.default_basepath='/home/letwang/workspace/HookPHP/log'
seaslog.default_template = '%T | %L | %P | %Q | %t | %M | %H | %D | %R | %m | %I | %F | %U | %u | %C'

[xhprof]
extension=xhprof
xhprof.output_dir = '/var/log/xhprof'

[rar]
extension=rar

[msgpack]
extension=msgpack

[igbinary]
extension=igbinary

[amqp]
extension=amqp.so
amqp.login=admin
amqp.password=12345678

[varnish]
extension=varnish

[redis]
extension=redis

[mongodb]
extension=mongodb

[swoole]
extension=swoole
```
# Nginx|OpenResty
```
server {
	listen 80;
	root /home/letwang/workspace/HookPHP/public/admin/;
	index index.html index.htm index.php;
	error_log /var/log/nginx/www.admin.com-error.log error;
	access_log /var/log/nginx/www.admin.com-access.log combined;
	server_name www.admin.com;

	if (!-e $request_filename) {rewrite ^/(.*)  /index.php?$1 last;}

	location ~ \.php$ {
	       add_header Access-Control-Allow-Origin *;
	       add_header Strict-Transport-Security "max-age=31536000; includeSubdomains; preload";
	       add_header X-Frame-Options deny;
	       add_header X-Content-Type-Options nosniff;
	       add_header X-XSS-Protection "1; mode=block";
	       add_header Referrer-Policy "origin-when-cross-origin, strict-origin-when-cross-origin";
	       add_header Content-Security-Policy "default-src 'self' https://cdn.bootcss.com";
	       add_header X-Request-Id $request_id;

	       fastcgi_pass   127.0.0.1:9000;
	       fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	       include        fastcgi_params;
	 }

	location ~ \.(js|css|gif|jpg|jpeg|png|ico)$
	{
	       expires 1d;
	}
}

server {
	listen 80;
	root /home/letwang/workspace/HookPHP/public/iot/;
	index index.html index.htm index.php;
	error_log /var/log/nginx/www.iot.com-error.log error;
	access_log /var/log/nginx/www.iot.com-access.log combined;
	server_name www.iot.com;

	if (!-e $request_filename) {rewrite ^/(.*)  /index.php?$1 last;}

	location ~ \.php$ {
	       fastcgi_pass   127.0.0.1:9000;
	       fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	       include        fastcgi_params;
	 }
}

server {
	listen 80;
	root /home/letwang/workspace/HookPHP/public/paas/;
	index index.html index.htm index.php;
	error_log /var/log/nginx/www.paas.com-error.log error;
	access_log /var/log/nginx/www.paas.com-access.log combined;
	server_name www.paas.com;

	if (!-e $request_filename) {rewrite ^/(.*)  /index.php?$1 last;}

	location ~ \.php$ {
	       fastcgi_pass   127.0.0.1:9000;
	       fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	       include        fastcgi_params;
	 }
}

server {
	listen 80;
	root /home/letwang/workspace/HookPHP/public/payment/;
	index index.html index.htm index.php;
	error_log /var/log/nginx/www.payment.com-error.log error;
	access_log /var/log/nginx/www.payment.com-access.log combined;
	server_name www.payment.com;

	if (!-e $request_filename) {rewrite ^/(.*)  /index.php?$1 last;}

	location ~ \.php$ {
	       fastcgi_pass   127.0.0.1:9000;
	       fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	       include        fastcgi_params;
	 }
}

server {
	listen 80;
	root /home/letwang/workspace/HookPHP/public/store/;
	index index.html index.htm index.php;
	error_log /var/log/nginx/www.store.com-error.log error;
	access_log /var/log/nginx/www.store.com-access.log combined;
	server_name www.store.com;

	if (!-e $request_filename) {rewrite ^/(.*)  /index.php?$1 last;}

	location ~ \.php$ {
	       fastcgi_pass   127.0.0.1:9000;
	       fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	       include        fastcgi_params;
	 }
}
```
# Host
```
127.0.0.1 www.admin.com
127.0.0.1 www.iot.com
127.0.0.1 www.paas.com
127.0.0.1 www.payment.com
127.0.0.1 www.store.com
```
# Init
```
cd ~/workspace/HookPHP/
sudo chmod 777 -R ./log

composer.phar install

php app/admin/bin/install.php
php app/iot/bin/install.php
php app/paas/bin/install.php
php app/payment/bin/install.php
php app/store/bin/install.php
```
# Access
```
http://www.admin.com/
http://www.iot.com/
http://www.paas.com/
http://www.payment.com/
http://www.store.com/

admin@hookphp.com
12345678
```

# 简介
创作此框架的作者是LetWang，2007年ASP，2008年ASP.NET(C#)，从2009年一直PHP。

虽然中间几次创业，看过太多的源码，也曾服务于海外多家机构，但越是这样越发现自己的渺小：**一个人无法改变太多，需要带动整个群体一起进步！**。于是内心酝酿近10年的PHP框架诞生了！

此框架旨在降低企业在启动新项目时的时间成本，加速研发者的研发节奏，打破从0到1的惯例，直接从0.1开始！

# 理念
配置即产出。

# 特点
+ 追求极客，行业主流解决方案最新版
+ 能用 C 扩展解决的，坚决不用Composer
+ 一款自带DB的框架，业务SQL集中化管理
+ 集成行业通用功能：`用户管理`、`资源管理`、`角色管理`、`权限管理`、`配置管理`、`翻译管理`、`SEO管理`、`多菜单管理`、`多语言管理`、`多模块管理`、`多模板管理`、`多终端管理`、`多平台管理`...
+ 支持行业主流特性：`微服务`、`多线程`、`多进程`、`常驻内存`、`主从分离`、`负载均衡`...

# 环境
## [PHP 7.3]
```
sudo apt-get install php7.3-common php7.3-cli php7.3-bcmath php7.3-dev php7.3-xml php7.3-opcache php7.3-mbstring php7.3-mysql php7.3-fpm php7.3-gd php7.3-zip php7.3-curl php7.3-intl php7.3-json
```
### [C Extensions]
#### [Yaf 3.0.7][6]
[6]: http://php.net/yaf
```
sudo pecl install yaf

[yaf]
extension=yaf
yaf.use_namespace = 1
yaf.use_spl_autoload = 1
yaf.library = /home/letwang/workspace/HookPHP/vendor/
```
#### [Yaconf 1.0.7][7]
[7]: http://php.net/yaconf
```
sudo pecl install yaconf

[yaconf]
extension=yaconf
yaconf.directory = /home/letwang/workspace/HookPHP/conf/
```
#### [SeasLog 1.8.6][3]
[3]: http://php.net/manual/zh/book.seaslog.php
```
sudo pecl install seaslog

[seaslog]
extension=seaslog
seaslog.trace_notice=1
seaslog.trace_warning=1
seaslog.default_basepath='/home/letwang/workspace/HookPHP/log'
seaslog.default_template = '%T | %L | %P | %Q | %t | %M | %H | %D | %R | %m | %I | %F | %U | %u | %C'
```
#### [Xhprof][8]
[8]: http://php.net/xhprof
```
git clone https://github.com/longxinH/xhprof.git ./xhprof
cd xhprof/extension/
phpize7.3
./configure --with-php-config=php-config7.3
make && sudo make install
sudo apt-get install graphviz-dev

[xhprof]
extension=xhprof
xhprof.output_dir = '/var/log/xhprof'
```
#### [Rar][18]
[18]: http://php.net/rar
```
sudo pecl install rar

[rar]
extension=rar
```
### [php.ini]
```
[Session]
session.save_handler = redis
session.save_path = "tcp://127.0.0.1:6379?weight=1&auth=123456&database=0, tcp://127.0.0.1:6379?weight=2&auth=123456&database=0"
```
### [hosts]
```
sudo vim /etc/hosts

127.0.0.1 www.admin.com
127.0.0.1 www.erp.com
127.0.0.1 www.paas.com
```
## [Nginx 1.15.5][11]
[11]: https://nginx.org/en/download.html
```
server {
	listen 80;
	root /home/letwang/workspace/HookPHP/public/;
	index index.html index.htm index.php admin.php;
	autoindex on;autoindex_exact_size off;autoindex_localtime on;
	error_log /var/log/nginx/www.admin.com-error.log error;access_log /var/log/nginx/www.admin.com-access.log combined;
	server_name www.admin.com;

	if (!-e $request_filename) {rewrite ^/(.*)  /admin.php?$1 last;}

	location ~ \.php$ {
	       fastcgi_pass   127.0.0.1:9000;
	       fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	       include        fastcgi_params;
	 }
}

server {
	listen 80;
	root /home/letwang/workspace/HookPHP/public/;
	index index.html index.htm index.php erp.php;
	autoindex on;autoindex_exact_size off;autoindex_localtime on;
	error_log /var/log/nginx/www.erp.com-error.log error;access_log /var/log/nginx/www.erp.com-access.log combined;
	server_name www.erp.com;

	if (!-e $request_filename) {rewrite ^/(.*)  /erp.php?$1 last;}

	location ~ \.php$ {
	       fastcgi_pass   127.0.0.1:9000;
	       fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	       include        fastcgi_params;
	 }
}

server {
	listen 80;
	root /home/letwang/workspace/HookPHP/public/;
	index index.html index.htm index.php paas.php;
	autoindex on;autoindex_exact_size off;autoindex_localtime on;
	error_log /var/log/nginx/www.paas.com-error.log error;access_log /var/log/nginx/www.paas.com-access.log combined;
	server_name www.paas.com;

	if (!-e $request_filename) {rewrite ^/(.*)  /paas.php?$1 last;}

	location ~ \.php$ {
	       fastcgi_pass   127.0.0.1:9000;
	       fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	       include        fastcgi_params;
	 }
}
```
## [MySQL 8.0.12][10]
[10]: https://dev.mysql.com/downloads/mysql/
## [ProxySQL 1.4.12][15]
[15]: https://proxysql.com/
## [Redis 5.0][1]
[1]: https://redis.io/download
## [RedisProxy][16]
[16]: https://github.com/twitter/twemproxy
```
sudo pecl install redis

[redis]
extension=redis
```
## [MongoDB 4.2][2]
[2]: https://docs.mongodb.com/manual/administration/install-on-linux/
```
sudo pecl install mongodb

[mongodb]
extension=mongodb
```
## [MongoDB Sharded Cluster][17]
[17]: https://docs.mongodb.com/manual/core/sharded-cluster-components/
## [RabbitMQ 3.7.8][4]
[4]: http://www.rabbitmq.com/
## [AMQP 1.9.3][5]
[5]: http://www.php.net/manual/pl/book.amqp.php
```
sudo pecl install amqp

[amqp]
extension=amqp
```
## [Sphinx 3.0.3][9]
[9]: http://sphinxsearch.com/downloads/
```
wget -P /home/sphinx http://sphinxsearch.com/files/sphinx-3.0.3-facc3fb-linux-amd64.tar.gz
```
## [Varnish 6.1.0][12]
[12]: https://varnish-cache.org/
```
sudo pecl install varnish

[varnish]
extension=varnish
```
## [Composer][13]
[13]: https://www.phpcomposer.com/
```
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

## [Tika][14]
[14]: https://tika.apache.org/
```
wget -P /home/letwang/workspace/HookPHP/vendor/Hook/Tika http://mirrors.hust.edu.cn/apache/tika/tika-app-1.19.1.jar
```

## [安装]
```
cd ~/workspace/HookPHP/

composer.phar install

php app/admin/bin/install.php
php app/erp/bin/install.php
php app/paas/bin/install.php
```
# 访问
```
http://www.admin.com/
http://www.erp.com/
http://www.paas.com/

admin@hookphp.com
12345678
```
# 演示
![截图1](https://github.com/letwang/HookPHP/blob/master/public/assets/demo_1.png?raw=true)

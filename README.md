# 简介
创作此框架的作者是LetWang，2007年ASP，2008年ASP.NET(C#)，从2009年一直PHP。

虽然中间几次创业，看过太多的源码，也曾服务于海外多家机构，但越是这样越发现自己的渺小：**一个人无法改变太多，需要带动整个群体一起进步！**。于是内心酝酿近10年的PHP框架诞生了！

此框架旨在降低企业在启动新项目时的时间成本，加速研发者的研发节奏，打破从0到1的惯例，直接从0.1开始！

# 理念
配置即产出。

# 路线图
+ ✅诞生：初始化YAF框架，基于PHP5 OOP，含 8年常用类库、SQL建模、外键约束
+ ✅引入：Bootstrap，解决多终端自适应显示问题
+ ✅支持：用户登录模块
+ ✅支持：目录安全访问
+ ✅支持：业务SQL集中管控
+ ✅支持：多语言ACL权限表设计
+ ✅支持：映射数据库表结构为内存缓存
+ ✅支持：单表CRUD操作模型
+ ✅支持：PHP7+规范+重构
+ ✅支持：Mysql主从、Redis集群、MongoDB分片
+ ✅支持：模块组件化、事件触发机制
+ ✅支持：多应用配置域名同时运行
+ ✅引入：composer:mongodb
+ ✅支持：YAF全局库、本地库
+ ✅支持：FILTER Validate
+ ✅支持：ACL业务CRUD 抽象model CRUD
+ ✅支持：Form组件
+ ✅支持：同页面批量渲染Form动态生成控件ID
+ ✅支持：业务配置数据常驻内存
+ ✅支持：前后端正则验证常驻内存
+ ✅支持：表字段大小范围常驻内存
+ ✅支持：多语言翻译常驻内存
+ ✅支持：无CSRF 无XSS 无Session Hijack 无SQL Injection
+ ✅支持：用户密码传输 OpenSSL AES-256-CBC加密/解密
+ ✅支持：用户 管理员 分表
+ ✅支持：SeasLog收集日志
+ ✅支持：Tika抽取任意文档内容
+ ✅支持：业务分库 DB分离：ProxySQL、RedisProxy、MongoSharding
+ 📌待办：安装Looper模板
+ 📌待办：基础功能CRUD
+ 📌待办：微信 QQ 微博 短信...注册 登陆 退出
+ 📌待办：邀请注册 分享 收集大数据 社工分析
+ 📌待办：开放API平台 QPS CACHE

# 特点
+ 追求极客：PHP7.3+C系扩展+MySql8.0+Mongo4.0+Redis4.0+Sphinx4.0
+ 能用 C 扩展解决的，坚决不用Composer
+ 一款自带DB的框架，业务SQL集中化管理
+ 集成行业通用功能：`用户管理`、`资源管理`、`角色管理`、`权限管理`、`配置管理`、`翻译管理`、`SEO管理`、`多菜单管理`、`多语言管理`、`多模块管理`、`多模板管理`、`多终端管理`、`多平台管理`...
+ 支持行业主流特性：`微服务`、`主从分离`、`负载均衡`...

# 环境
```
sudo apt-get install php7.2-common php7.2-cli php7.2-bcmath php7.2-dev php7.2-xml php7.2-mbstring php7.2-mysql  php7.2-fpm php7.2-gd php7.2-zip php7.2-curl php7.2-intl php7.2-json
```
## session
```
[Session]
session.save_handler = redis
session.save_path = "tcp://127.0.0.1:6379?weight=1&auth=123456&database=0, tcp://127.0.0.1:6379?weight=2&auth=123456&database=0"
```
## redis
```
sudo pecl install redis

[redis]
extension=redis
```
## mongodb
```
sudo pecl install mongodb

[mongodb]
extension=mongodb
```
## seaslog
```
sudo pecl install seaslog

[seaslog]
extension=seaslog
seaslog.trace_notice=1
seaslog.trace_warning=1
seaslog.default_basepath='/home/你的项目绝对路径/HookPHP/log'
seaslog.default_template = '%T | %L | %P | %Q | %t | %M | %H | %D | %R | %m | %I | %F | %U | %u | %C'
```
## yar
```
sudo pecl install yar

[yar]
extension=yar
```
## yaf
```
sudo pecl install yaf

[yaf]
extension=yaf
yaf.use_namespace = 1
yaf.use_spl_autoload = 1
yaf.library = /home/你的项目绝对路径/HookPHP/vendor/
```
## yaconf
```
sudo pecl install yaconf

[yaconf]
extension=yaconf
yaconf.directory = /home/你的项目绝对路径/HookPHP/conf/
```
## xhprof
```
git clone https://github.com/longxinH/xhprof.git ./xhprof
cd xhprof/extension/
phpize7.2
./configure --with-php-config=php-config7.2
make && sudo make install
sudo apt-get install graphviz-dev

[xhprof]
extension=xhprof
xhprof.output_dir = '/var/log/xhprof'
```
## swoole
```
sudo pecl install swoole

[swoole]
extension=swoole
```
# vendor
```
composer.phar install
wget -P /home/你的项目绝对路径/HookPHP/vendor/Hook/Tika http://mirrors.hust.edu.cn/apache/tika/tika-app-1.18.jar
php public/index.php
```

# Nginx规则
```
server {
	listen 80;
	root /home/你的项目绝对路径/HookPHP/public/;
	index index.html index.htm index.php;
	autoindex on;autoindex_exact_size off;autoindex_localtime on;
	error_log /var/log/nginx/www.svn.com-error.log error;access_log /var/log/nginx/www.svn.com-access.log combined;
	server_name www.svn.com;

	if (!-e $request_filename) {rewrite ^/(.*)  /index.php?$1 last;}

	location ~ \.php$ {
	       fastcgi_pass   127.0.0.1:9000;
	       fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	       include        fastcgi_params;
	 }
}
```

# 账户
```
admin@hookphp.com
12345678
```

# 简介
创作此框架的作者是LetWang，2007年ASP，2008年ASP.NET(C#)，从2009年一直PHP。

虽然中间几次创业，看过太多的源码，也曾服务于海外多家机构，但越是这样越发现自己的渺小：**一个人无法改变太多，需要带动整个群体一起进步！**。于是内心酝酿近10年的PHP框架诞生了！

此框架旨在降低企业在启动新项目时的时间成本，加速研发者的研发节奏，打破从0到1的惯例，直接从0.1开始！

# 理念
配置即产出。

# 路线图
✅诞生：初始化YAF框架，基于PHP5 OOP，含 8年常用类库、SQL建模、外键约束
✅引入：Bootstrap，解决多终端自适应显示问题
✅支持：用户登录模块
✅支持：目录安全访问
✅支持：业务SQL集中管控
✅支持：多语言ACL权限表设计
✅支持：映射数据库表结构为内存缓存
✅支持：单表CRUD操作模型
✅支持：PHP7+规范+重构
✅支持：Mysql主从、Redis集群、MongoDB分片
✅支持：模块组件化、事件触发机制
✅支持：多应用配置域名同时运行
✅引入：composer:mongodb
✅支持：YAF全局库、本地库
✅支持：FILTER Validate
✅支持：ACL业务CRUD 抽象model CRUD
✅支持：Form组件
📌待办：form [lable for] [input id]
📌待办：field data 重复
📌待办：filter 正则 长度
📌待办：前后端长度验证统一 手动？ 自动
📌待办：多语言翻译
📌待办：YAC Zend OPCache I18n初始化
📌待办：报错提示统一
📌待办：CSRF 动态token生效 session反劫持
📌待办：密码加密
📌待办：用户 管理员 分表
📌待办：seaslog 日志
📌待办：列表页面 model
📌待办：套bootstrap模板(app web ipad)
📌待办：基础菜单 基础功能CRUD 同步CACHE
📌待办：微信 QQ 微博 短信...注册 登陆 推出
📌待办：邀请注册 分享 收集大数据 社工分析
📌待办：开放API平台 QPS CACHE


# 特点
1.基于 PHP C 扩展：YAF

2.能用 C 扩展解决的，坚决不用Composer

3.追求极客，使用行业技术栈最新特性

3.一款自带DB的框架，业务SQL集中化管理

4.集成行业通用功能：`用户管理`、`资源管理`、`角色管理`、`权限管理`、`配置管理`、`翻译管理`、`SEO管理`、`多菜单管理`、`多语言管理`、`多模块管理`、`多模板管理`、`多终端管理`、`多平台管理`...

5.支持行业主流特性：`读写分离`、`负载均衡`...

# 依赖
+ http://php.net/
+ http://php.net/manual/zh/ref.pdo-mysql.php
+ http://nginx.org/
+ http://pecl.php.net/package/yaf
+ http://pecl.php.net/package/redis
+ http://pecl.php.net/package/mongodb
+ http://pecl.php.net/package/sphinx
+ http://pecl.php.net/package/swoole
+ http://pecl.php.net/package/seaslog
+ http://pecl.php.net/package/lua

# 配置
## composer.phar install
## php.ini
```
[Session]
session.save_handler = redis
session.save_path = "tcp://127.0.0.1:6379?weight=1&auth=123456&database=0, tcp://127.0.0.1:6379?weight=2&auth=123456&database=0"

[yaf]
yaf.use_namespace = 1
yaf.use_spl_autoload = 1
yaf.library = /home/你的项目绝对路径/HookPHP/vendor/
```
## Nginx规则
```
server {
	listen 80;
	root /home/test/workspace/HookPHP/public/;
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

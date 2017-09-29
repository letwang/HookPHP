# 简介
这是一款出自10年+编程经验者创造的PHP框架！

# 特点
上手快、成本低、PHP7起步、重安全、高性能、SEO优化

# 依赖
1.http://pecl.php.net/package/yaf
2.http://pecl.php.net/package/redis
3.http://pecl.php.net/package/mongodb
4.http://sphinxsearch.com/downloads/release/

# 配置
## php.ini
```
[Session]
session.save_handler = redis
session.save_path = "tcp://127.0.0.1:6379?weight=1&auth=123456&database=0, tcp://127.0.0.1:6379?weight=2&auth=123456&database=0"

[yaf]
yaf.use_namespace = 1
yaf.use_spl_autoload = 1
## Nginx伪静态规则
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
```
# 账户
```
admin@hookphp.com
12345678
```
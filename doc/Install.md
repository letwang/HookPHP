# Install
## 1.Host
```
127.0.0.1 www.admin.com
127.0.0.1 www.iot.com
127.0.0.1 www.paas.com
127.0.0.1 www.payment.com
127.0.0.1 www.store.com
```
## 2.Docker
```
git clone https://github.com/letwang/HookPHP.git && cd HookPHP &&
sudo docker run -itd -p 81:80 -p 3307:3306 -p 6380:6379 -p 27018:27017 --name hookphp \
-v `pwd`/docker/mongodb/mongod.conf:/etc/mongod.conf \
-v `pwd`/docker/mysql/mysql.cnf:/etc/mysql/conf.d/mysql.cnf \
-v `pwd`/docker/nginx/nginx.conf:/etc/nginx/nginx.conf \
-v `pwd`/docker/nginx/conf.d:/etc/nginx/conf.d \
-v `pwd`/docker/php/7.3/cli/php.ini:/etc/php/7.3/cli/php.ini \
-v `pwd`/docker/php/7.3/fpm/php-fpm.conf:/etc/php/7.3/fpm/php-fpm.conf \
-v `pwd`/docker/php/7.3/fpm/php.ini:/etc/php/7.3/fpm/php.ini \
-v `pwd`/docker/php/7.3/fpm/pool.d:/etc/php/7.3/fpm/pool.d \
-v `pwd`/docker/redis/redis.conf:/etc/redis/redis.conf \
-v `pwd`/docker/log:/var/log \
-v `pwd`/../:/usr/share/nginx/html \
letwang/hookphp zsh && sudo docker exec -it hookphp zsh /usr/share/nginx/html/HookPHP/docker/init.sh
```
# [Command][1]
```
# Entering Container
sudo docker exec -it hookphp zsh

# Exit Container
exit

# Delete Container
sudo docker rm -f hookphp
```
# Demo
```
http://www.admin.com:81/
http://www.iot.com:81/
http://www.paas.com:81/
http://www.payment.com:81/
http://www.store.com:81/

account:	admin@hookphp.com
password:	12345678
```
# [Description][2]

# [Requirements]
- Linux(Ubuntu etc.)
- Nginx 1.17
- MySQL 8.0
- ProxySQL 2.0
- PHP 7.4
- [PHP extensions][3]
- Redis 5.0
- Redis Cluster
- MongoDB 4.2
- MongoDB Cluster
- RabbitMQ 3.7.17
- Sphinx 3.1.1
- Varnish 6.2.0
- Composer 1.9
- Tika 1.22

[1]: https://my.oschina.net/cart/blog/3061173
[2]: https://my.oschina.net/cart/blog/2986804
[3]: https://github.com/letwang/HookPHP/blob/master/composer.json
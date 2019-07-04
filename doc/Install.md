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
sudo rm -rf HookPHP &&
git clone https://github.com/letwang/HookPHP.git &&
cd HookPHP &&
sudo docker run -itd -p 8080:80 --name hookphp \
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
letwang/hookphp /bin/bash &&
sudo docker ps -a &&
sudo docker images &&
sudo docker exec -it hookphp bash /usr/share/nginx/html/HookPHP/docker/init.sh
```
# Command
```
#删除容器
sudo docker rm -f hookphp
```
# Demo
```
http://www.admin.com:8080/
http://www.iot.com:8080/
http://www.paas.com:8080/
http://www.payment.com:8080/
http://www.store.com:8080/

account:	admin@hookphp.com
password:	12345678
```
# Description
https://my.oschina.net/cart/blog/2986804

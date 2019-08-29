[![996.icu](https://img.shields.io/badge/link-996.icu-red.svg)](https://996.icu)
[![LICENSE](https://img.shields.io/badge/license-Anti%20996-blue.svg)](https://github.com/996icu/996.ICU/blob/master/LICENSE)

# 简介
创作此框架的作者是LetWang，2007年ASP，2008年ASP.NET(C#)，从2009年一直PHP。

虽然中间几次创业，看过太多的源码，也曾服务于海外多家机构，但越是这样越发现自己的渺小：**一个人无法改变太多，需要带动整个群体一起进步！**。于是内心酝酿近10年的PHP框架诞生了！

# [文档][1]

# 参与
如果你觉得此项目很好，请点击右上角的Star，让更多的人看到，一起腾飞！

如果你想贡献代码，请直接在线新增、编辑源码，Github会自动帮你Fork项目，你要做的就是点击提交，比如基于HookPHP [开发平台][2]、[开发模块][3]、[开发插件][4]等。

# 架构
![HookPHP_架构](https://github.com/letwang/HookPHP/blob/master/public/demo/architecture.png?raw=true)

# 社区
![HookPHP_社区_QQ](https://github.com/letwang/HookPHP/blob/master/public/demo/qq.jpg?raw=true)

# 教程
![HookPHP_社区_知识星球](https://github.com/letwang/HookPHP/blob/master/public/demo/zsxq.png?raw=true)

# Docker快速启动
```bash
git clone https://github.com/letwang/HookPHP.git
cd HookPHP
$ docker run -itd -p 81:80 -p 3307:3306 -p 6380:6379 -p 27018:27017 --name hookphp \
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
letwang/hookphp zsh && docker exec -it hookphp zsh /usr/share/nginx/html/HookPHP/docker/init.sh
```

# 演示
![HookPHP_演示_1](https://github.com/letwang/HookPHP/blob/master/public/demo/1.png?raw=true)

[1]: https://github.com/letwang/HookPHP/wiki
[2]: https://github.com/letwang/HookPHP/blob/master/app/
[3]: https://github.com/letwang/HookPHP/blob/master/app/admin/modules/
[4]: https://github.com/letwang/HookPHP/blob/master/app/admin/hooks/

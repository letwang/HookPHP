<?php
namespace Hook\Sql;

class Install
{
    const SQL_TABLES = "
CREATE TABLE `hp_acl_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_000026` (`app_id`),
  CONSTRAINT `FK_000026` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_acl_group` VALUES (1,1,1,1493439330,1493439330);

CREATE TABLE `hp_acl_group_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `name` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`lang_id`) USING BTREE,
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000009` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000012` FOREIGN KEY (`group_id`) REFERENCES `hp_acl_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_acl_group_lang` VALUES (1,1,1,1493439330,1493439330,'华东地区订单授权');

CREATE TABLE `hp_acl_group_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`resource_id`),
  KEY `resource_id` (`resource_id`),
  CONSTRAINT `FK_000001` FOREIGN KEY (`group_id`) REFERENCES `hp_acl_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000002` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_acl_group_resource` VALUES (1,1,1,1,1493439330),(2,1,2,1,1493439330),(3,1,3,1,1493439330);

CREATE TABLE `hp_acl_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `app` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `module` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `controller` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `action` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `AMCA` (`app`,`module`,`controller`,`action`) USING BTREE,
  KEY `FK_000027` (`app_id`),
  CONSTRAINT `FK_000027` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_acl_resource` VALUES (1,1,1,1493439330,1493439330,'store','order','list','view'),(2,1,1,1493439330,1493439330,'store','order','refund','edit'),(3,1,1,1493439330,1493439330,'store','order','detail','delete');

CREATE TABLE `hp_acl_resource_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `name` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resource_id` (`resource_id`,`lang_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000010` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000013` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_acl_resource_lang` VALUES (1,1,1,1493439330,1493439330,'订单列表查看'),(2,1,2,1493439330,1493439330,'订单退货编辑'),(3,1,3,1493439330,1493439330,'订单详情删除');

CREATE TABLE `hp_acl_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_000028` (`app_id`),
  CONSTRAINT `FK_000028` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_acl_role` VALUES (1,1,1,1493439330,1493439330),(2,1,1,1493439330,1493439330),(3,1,1,1493439330,1493439330),(4,1,1,1493439330,1493439330);

CREATE TABLE `hp_acl_role_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `name` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`role_id`,`lang_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000011` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000014` FOREIGN KEY (`role_id`) REFERENCES `hp_acl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_acl_role_lang` VALUES (1,1,1,1493439330,1493439330,'江苏办总经理'),(2,1,2,1493439330,1493439330,'上海办总经理'),(3,1,3,1493439330,1493439330,'昆山办经理'),(4,1,4,1493439330,1493439330,'苏州办总经理');

CREATE TABLE `hp_acl_role_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`role_id`,`resource_id`),
  KEY `resource_id` (`resource_id`),
  CONSTRAINT `FK_000003` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000004` FOREIGN KEY (`role_id`) REFERENCES `hp_acl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_acl_role_resource` VALUES (1,1,1,1,1493439330),(2,1,2,1,1493439330),(3,1,3,1,1493439330),(4,2,3,1,1493439330),(5,3,2,1,1493439330),(6,4,3,1,1493439330);

CREATE TABLE `hp_acl_user_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`resource_id`),
  KEY `resource_id` (`resource_id`),
  CONSTRAINT `FK_000005` FOREIGN KEY (`user_id`) REFERENCES `hp_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000006` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_acl_user_resource` VALUES (1,1,3,1,1493439330);

CREATE TABLE `hp_acl_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`role_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `FK_000007` FOREIGN KEY (`role_id`) REFERENCES `hp_acl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000008` FOREIGN KEY (`user_id`) REFERENCES `hp_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_acl_user_role` VALUES (1,1,1,1,1493439330),(2,1,2,1,1493439330),(3,1,3,1,1493439330),(4,1,4,1,1493439330);

CREATE TABLE `hp_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `name` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_app` VALUES (1,1,1493439330,1493439330,'admin','平台中控系统，统一管理各大平台'),(2,1,1493439330,1493439330,'erp','ERP系统'),(3,1,1493439330,1493439330,'paas','PAAS系统');

CREATE TABLE `hp_app_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_000031` (`app_id`),
  KEY `FK_000035` (`lang_id`),
  CONSTRAINT `FK_000031` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000035` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_app_lang` VALUES (1,1,1),(2,2,1),(3,3,1);

CREATE TABLE `hp_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `name` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`name`),
  KEY `FK_000029` (`app_id`),
  CONSTRAINT `FK_000029` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_config` VALUES (1,1,1493439330,1493439330,'HP_LANG_DEFAULT','1');

CREATE TABLE `hp_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `name` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`name`),
  KEY `FK_000030` (`app_id`),
  CONSTRAINT `FK_000030` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_hook` VALUES (1,1,0,1493439330,1493439330,'displayTop'),(2,1,1,1493439330,1493439330,'displayHead'),(3,1,2,1493439330,1493439330,'displayFoot');

CREATE TABLE `hp_hook_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hook_id` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `name` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `title` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hook_id` (`hook_id`,`lang_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000015` FOREIGN KEY (`hook_id`) REFERENCES `hp_hook` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000016` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_hook_lang` VALUES (1,1,1,1493439330,1493439330,'头部钩子','这里显示头部的钩子','所有头部的钩子按顺序依次显示在这里。');

CREATE TABLE `hp_hook_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hook_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `FK_000017` (`hook_id`,`module_id`) USING BTREE,
  KEY `FK_000018` (`module_id`),
  CONSTRAINT `FK_000017` FOREIGN KEY (`hook_id`) REFERENCES `hp_hook` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000018` FOREIGN KEY (`module_id`) REFERENCES `hp_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_hook_module` VALUES (1,1,1,0,1493439330,1493439330),(2,2,2,0,1493439330,1493439330),(3,3,3,2,1493439330,1493439330),(4,3,1,0,1493439330,1493439330),(5,3,2,1,1493439330,1493439330);

CREATE TABLE `hp_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `iso` char(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `lang` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `name` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_lang` VALUES (1,1,1493439330,1493439330,'cn','zh-cn','简体中文 (简体中文)'),(2,1,1493439330,1493439330,'en','en-us','English (English)');

CREATE TABLE `hp_manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `user` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass` char(95) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `phone` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lastname` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `firstname` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `lang_id` (`lang_id`) USING BTREE,
  CONSTRAINT `FK_000034` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_manager` VALUES (1,1,1,1493439330,1493439330,'admin@hookphp.com','\$argon2i\$v=19\$m=1024,t=2,p=2\$c2NtWmdCb255NGZZUFBOLw\$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA','','','bobstephen','');

CREATE TABLE `hp_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `parent` int(10) unsigned DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `url` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `icon` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `parent` (`parent`),
  KEY `FK_000032` (`app_id`),
  CONSTRAINT `FK_000022` FOREIGN KEY (`parent`) REFERENCES `hp_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000032` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_menu` VALUES (1,1,NULL,1,1,1493439330,1493439330,'','people'),(2,1,1,1,0,1493439330,1493439330,'user_index',''),(3,1,NULL,1,2,1493439330,1493439330,'','grid-two-up'),(4,1,3,1,0,1493439330,1493439330,'acl_index',''),(5,1,3,1,0,1493439330,1493439330,'acl_resource',''),(6,1,3,1,0,1493439330,1493439330,'acl_role',''),(7,1,3,1,0,1493439330,1493439330,'acl_user',''),(8,1,3,1,0,1493439330,1493439330,'acl_group',''),(9,1,NULL,1,3,1493439330,1493439330,'','bar-chart'),(10,1,9,1,0,1493439330,1493439330,'config',''),(11,1,NULL,1,4,1493439330,1493439330,'','list-rich'),(12,1,11,1,0,1493439330,1493439330,'translation',''),(13,1,NULL,1,5,1493439330,1493439330,'','wrench'),(14,1,13,1,0,1493439330,1493439330,'manager',''),(15,1,NULL,1,6,1493439330,1493439330,'','browser'),(16,1,15,1,0,1493439330,1493439330,'menu',''),(17,1,NULL,1,7,1493439330,1493439330,'','infinity'),(18,1,17,1,0,1493439330,1493439330,'lang',''),(19,1,NULL,1,8,1493439330,1493439330,'','media-skip-backward'),(20,1,19,1,0,1493439330,1493439330,'hook_index',''),(21,1,19,1,0,1493439330,1493439330,'hook_module',''),(22,1,NULL,1,9,1493439330,1493439330,'','resize-both'),(23,1,22,1,0,1493439330,1493439330,'theme',''),(24,1,NULL,1,10,1493439330,1493439330,'','calendar'),(25,1,24,1,0,1493439330,1493439330,'app','');

CREATE TABLE `hp_menu_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `name` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_000019` (`menu_id`,`lang_id`) USING BTREE,
  KEY `FK_000020` (`lang_id`) USING BTREE,
  CONSTRAINT `FK_000019` FOREIGN KEY (`menu_id`) REFERENCES `hp_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000020` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_menu_lang` VALUES (1,1,1,1493439330,1493439330,'用户管理'),(2,2,1,1493439330,1493439330,'用户'),(3,3,1,1493439330,1493439330,'权限管理'),(4,4,1,1493439330,1493439330,'权限'),(5,5,1,1493439330,1493439330,'资源'),(6,6,1,1493439330,1493439330,'角色'),(7,7,1,1493439330,1493439330,'用户'),(8,8,1,1493439330,1493439330,'分组'),(9,9,1,1493439330,1493439330,'配置管理'),(10,10,1,1493439330,1493439330,'配置'),(11,11,1,1493439330,1493439330,'翻译管理'),(12,12,1,1493439330,1493439330,'翻译'),(13,13,1,1493439330,1493439330,'超管管理'),(14,14,1,1493439330,1493439330,'超级管理员'),(15,15,1,1493439330,1493439330,'菜单管理'),(16,16,1,1493439330,1493439330,'菜单'),(17,17,1,1493439330,1493439330,'语言管理'),(18,18,1,1493439330,1493439330,'语言'),(19,19,1,1493439330,1493439330,'模块管理'),(20,20,1,1493439330,1493439330,'钩子'),(21,21,1,1493439330,1493439330,'模块'),(22,22,1,1493439330,1493439330,'模板管理'),(23,23,1,1493439330,1493439330,'模板'),(24,24,1,1493439330,1493439330,'平台管理'),(25,25,1,1493439330,1493439330,'平台');

CREATE TABLE `hp_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `version` char(8) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `name` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`name`),
  KEY `FK_000033` (`app_id`),
  CONSTRAINT `FK_000033` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_module` VALUES (1,1,1,1493439330,1493439330,'0.0.1','One'),(2,1,1,1493439330,1493439330,'0.0.1','Two'),(3,1,1,1493439330,1493439330,'0.0.1','Three');

CREATE TABLE `hp_translation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_lang_from` tinyint(3) unsigned NOT NULL,
  `id_lang_to` tinyint(3) unsigned NOT NULL,
  `key_crc32` int(10) unsigned NOT NULL,
  `key` text NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_lang_from_id_lang_to_key_crc32` (`id_lang_from`,`id_lang_to`,`key_crc32`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `user` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass` char(95) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `phone` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lastname` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `firstname` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `lang_id` (`lang_id`) USING BTREE,
  CONSTRAINT `FK_000021` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `hp_user` VALUES (1,1,1,1493439330,1493439330,'test@hotmail.com','\$argon2i\$v=19\$m=1024,t=2,p=2\$c2NtWmdCb255NGZZUFBOLw\$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA','','','bobstephen','');
";
}
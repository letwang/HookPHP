<?php
namespace Hook\Sql;

class Install
{
    const CREATE_DATA = "
SET FOREIGN_KEY_CHECKS = 0;
CREATE TABLE `hp_acl_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_000026` (`app_id`),
  CONSTRAINT `FK_000026` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_acl_group` VALUES (1,1,1,1493439330,1493439330);
CREATE TABLE `hp_acl_group_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`lang_id`) USING BTREE,
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000009` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000012` FOREIGN KEY (`group_id`) REFERENCES `hp_acl_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_acl_group_lang` VALUES (1,1,1,'华东地区订单授权'),(2,2,1,'East China order authorization');
CREATE TABLE `hp_acl_group_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`resource_id`),
  KEY `resource_id` (`resource_id`),
  CONSTRAINT `FK_000001` FOREIGN KEY (`group_id`) REFERENCES `hp_acl_group` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000002` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_acl_group_resource` VALUES (1,1,1493439330,1,1),(2,1,1493439330,1,2),(3,1,1493439330,1,3);
CREATE TABLE `hp_acl_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `module` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `controller` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `action` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `MCA` (`module`,`controller`,`action`) USING BTREE,
  KEY `FK_000027` (`app_id`),
  CONSTRAINT `FK_000027` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_acl_resource` VALUES (1,1,1,1493439330,1493439330,'order','list','view'),(2,1,1,1493439330,1493439330,'order','refund','edit'),(3,1,1,1493439330,1493439330,'order','detail','delete');
CREATE TABLE `hp_acl_resource_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resource_id` (`resource_id`,`lang_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000010` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000013` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_acl_resource_lang` VALUES (1,1,1,'订单列表查看'),(2,1,2,'订单退货编辑'),(3,1,3,'订单详情删除'),(4,2,1,'Order list view'),(5,2,2,'Order return editing'),(6,2,3,'Order details deleted');
CREATE TABLE `hp_acl_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_000028` (`app_id`),
  CONSTRAINT `FK_000028` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_acl_role` VALUES (1,1,1,1493439330,1493439330),(2,1,1,1493439330,1493439330),(3,1,1,1493439330,1493439330),(4,1,1,1493439330,1493439330);
CREATE TABLE `hp_acl_role_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`role_id`,`lang_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000011` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000014` FOREIGN KEY (`role_id`) REFERENCES `hp_acl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_acl_role_lang` VALUES (1,1,1,'江苏办总经理'),(2,1,2,'上海办总经理'),(3,1,3,'昆山办经理'),(4,1,4,'苏州办总经理'),(5,2,1,'General Manager of Jiangsu'),(6,2,2,'General Manager of Shanghai'),(7,2,3,'Kunshan Office Manager'),(8,2,4,'General Manager of Suzhou');
CREATE TABLE `hp_acl_role_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`role_id`,`resource_id`),
  KEY `resource_id` (`resource_id`),
  CONSTRAINT `FK_000003` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000004` FOREIGN KEY (`role_id`) REFERENCES `hp_acl_role` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_acl_role_resource` VALUES (1,1,1493439330,1,1),(2,1,1493439330,1,2),(3,1,1493439330,1,3),(4,1,1493439330,2,3),(5,1,1493439330,3,2),(6,1,1493439330,4,3);
CREATE TABLE `hp_acl_user_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`resource_id`),
  KEY `resource_id` (`resource_id`),
  CONSTRAINT `FK_000005` FOREIGN KEY (`user_id`) REFERENCES `hp_user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000006` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_acl_user_resource` VALUES (1,1,1493439330,1,3);
CREATE TABLE `hp_acl_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`role_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `FK_000007` FOREIGN KEY (`role_id`) REFERENCES `hp_acl_role` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000008` FOREIGN KEY (`user_id`) REFERENCES `hp_user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_acl_user_role` VALUES (1,1,1493439330,1,1),(2,1,1493439330,1,2),(3,1,1493439330,1,3),(4,1,1493439330,1,4);
CREATE TABLE `hp_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `key` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_app` VALUES (1,1,1493439330,1493439330,'admin'),(2,1,1493439330,1493439330,'erp'),(3,1,1493439330,1493439330,'paas');
CREATE TABLE `hp_app_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `app_id` int(10) unsigned NOT NULL,
  `title` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_000031` (`app_id`),
  KEY `FK_000035` (`lang_id`),
  CONSTRAINT `FK_000031` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000035` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_app_lang` VALUES (1,1,1,'平台中控系统，统一管理各大平台',''),(2,1,2,'ERP系统',''),(3,1,3,'PAAS系统',''),(4,2,1,'Platform central control system',''),(5,2,2,'ERP system',''),(6,2,3,'PAAS system','');
CREATE TABLE `hp_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `key` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `FK_000029` (`app_id`),
  CONSTRAINT `FK_000029` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_config` VALUES (1,1,1,1493439330,1493439330,'APP_LANG_NAME','zh-cn'),(2,1,1,1493439330,1493439330,'APP_THEME_NAME','default');
CREATE TABLE `hp_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `key` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `FK_000030` (`app_id`),
  CONSTRAINT `FK_000030` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_hook` VALUES (1,1,1,1493439330,1493439330,0,'displayTop'),(2,1,1,1493439330,1493439330,1,'displayHead'),(3,1,1,1493439330,1493439330,2,'displayFoot');
CREATE TABLE `hp_hook_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `hook_id` int(10) unsigned NOT NULL,
  `title` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hook_id` (`hook_id`,`lang_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000015` FOREIGN KEY (`hook_id`) REFERENCES `hp_hook` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000016` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_hook_lang` VALUES (1,1,1,'顶部钩子','所有顶部的钩子按顺序依次显示在这里。'),(2,1,2,'头部钩子','所有头部的钩子按顺序依次显示在这里。'),(3,1,3,'尾部钩子','所有尾部的钩子按顺序依次显示在这里。'),(4,2,1,'Top hook','All the top hooks are shown here in order.'),(5,2,2,'Head hook','The hooks of all the heads are shown here in order.'),(6,2,3,'Tail hook','All tail hooks are shown here in order.');
CREATE TABLE `hp_hook_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `hook_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `FK_000017` (`hook_id`,`module_id`) USING BTREE,
  KEY `FK_000018` (`module_id`),
  CONSTRAINT `FK_000017` FOREIGN KEY (`hook_id`) REFERENCES `hp_hook` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000018` FOREIGN KEY (`module_id`) REFERENCES `hp_module` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_hook_module` VALUES (1,1493439330,1493439330,0,1,1),(2,1493439330,1493439330,0,2,2),(3,1493439330,1493439330,2,3,3),(4,1493439330,1493439330,0,3,1),(5,1493439330,1493439330,1,3,2);
CREATE TABLE `hp_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `iso` char(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `lang` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_lang` VALUES (1,1,1493439330,1493439330,'cn','zh-cn','简体中文 (简体中文)'),(2,1,1493439330,1493439330,'en','en-us','English (English)');
CREATE TABLE `hp_manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  `user` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `phone` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pass` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `lastname` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `firstname` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `lang_id` (`lang_id`) USING BTREE,
  KEY `FK_000038` (`app_id`),
  CONSTRAINT `FK_000034` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000038` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_manager` VALUES (1,1,1,1493439330,1493439330,1,'admin','admin@hookphp.com','15902366666','\$argon2i\$v=19\$m=1024,t=2,p=2\$c2NtWmdCb255NGZZUFBOLw\$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA','Stephen','Bob');
CREATE TABLE `hp_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `parent` int(10) unsigned DEFAULT NULL,
  `url` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `icon` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `parent` (`parent`),
  KEY `FK_000032` (`app_id`),
  CONSTRAINT `FK_000022` FOREIGN KEY (`parent`) REFERENCES `hp_menu` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000032` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_menu` VALUES (1,1,1,1493439330,1493439330,1,NULL,'','people'),(2,1,1,1493439330,1493439330,0,1,'user_user',''),(3,1,1,1493439330,1493439330,2,NULL,'','grid-two-up'),(4,1,1,1493439330,1493439330,0,3,'acl_index',''),(5,1,1,1493439330,1493439330,0,3,'acl_resource',''),(6,1,1,1493439330,1493439330,0,3,'acl_role',''),(7,1,1,1493439330,1493439330,0,3,'acl_user',''),(8,1,1,1493439330,1493439330,0,3,'acl_group',''),(9,1,1,1493439330,1493439330,3,NULL,'','bar-chart'),(10,1,1,1493439330,1493439330,0,9,'config',''),(11,1,1,1493439330,1493439330,4,NULL,'','list-rich'),(12,1,1,1493439330,1493439330,0,11,'translation',''),(13,1,1,1493439330,1493439330,5,NULL,'','wrench'),(14,1,1,1493439330,1493439330,0,13,'manager',''),(15,1,1,1493439330,1493439330,6,NULL,'','browser'),(16,1,1,1493439330,1493439330,0,15,'menu',''),(17,1,1,1493439330,1493439330,7,NULL,'','infinity'),(18,1,1,1493439330,1493439330,0,17,'lang',''),(19,1,1,1493439330,1493439330,8,NULL,'','media-skip-backward'),(20,1,1,1493439330,1493439330,0,19,'hook_hook',''),(21,1,1,1493439330,1493439330,0,19,'hook_module',''),(22,1,1,1493439330,1493439330,9,NULL,'','resize-both'),(23,1,1,1493439330,1493439330,0,22,'theme',''),(24,1,1,1493439330,1493439330,10,NULL,'','calendar'),(25,1,1,1493439330,1493439330,0,24,'app','');
CREATE TABLE `hp_menu_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `menu_id` int(10) unsigned NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_000019` (`menu_id`,`lang_id`) USING BTREE,
  KEY `FK_000020` (`lang_id`) USING BTREE,
  CONSTRAINT `FK_000019` FOREIGN KEY (`menu_id`) REFERENCES `hp_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000020` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_menu_lang` VALUES (1,1,1,'用户管理'),(2,1,2,'用户'),(3,1,3,'权限管理'),(4,1,4,'权限'),(5,1,5,'资源'),(6,1,6,'角色'),(7,1,7,'用户'),(8,1,8,'分组'),(9,1,9,'配置管理'),(10,1,10,'配置'),(11,1,11,'翻译管理'),(12,1,12,'翻译'),(13,1,13,'超管管理'),(14,1,14,'超级管理员'),(15,1,15,'菜单管理'),(16,1,16,'菜单'),(17,1,17,'语言管理'),(18,1,18,'语言'),(19,1,19,'模块管理'),(20,1,20,'钩子'),(21,1,21,'模块'),(22,1,22,'模板管理'),(23,1,23,'模板'),(24,1,24,'平台管理'),(25,1,25,'平台'),(26,2,1,'User Management'),(27,2,2,'User'),(28,2,3,'Permission management'),(29,2,4,'Permission'),(30,2,5,'Resource'),(31,2,6,'Character'),(32,2,7,'user'),(33,2,8,'Grouping'),(34,2,9,'Configuration management'),(35,2,10,'Configuration'),(36,2,11,'Translation management'),(37,2,12,'Translation'),(38,2,13,'Super management'),(39,2,14,'Super administrator'),(40,2,15,'Menu management'),(41,2,16,'Menu'),(42,2,17,'Language management'),(43,2,18,'Language'),(44,2,19,'Module management'),(45,2,20,'hook'),(46,2,21,'Module'),(47,2,22,'Template management'),(48,2,23,'Template'),(49,2,24,'Platform management'),(50,2,25,'Platform');
CREATE TABLE `hp_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `version` varchar(8) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `key` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `FK_000033` (`app_id`),
  CONSTRAINT `FK_000033` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_module` VALUES (1,1,1,1493439330,1493439330,'0.0.1','One'),(2,1,1,1493439330,1493439330,'0.0.1','Two'),(3,1,1,1493439330,1493439330,'0.0.1','Three');
CREATE TABLE `hp_theme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `key` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `FK_000036` (`app_id`),
  CONSTRAINT `FK_000036` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_theme` VALUES (1,1,1,1493439330,1493439330,'default'),(2,1,1,1493439330,1493439330,'winner');
CREATE TABLE `hp_translation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `from` tinyint(3) unsigned NOT NULL,
  `to` tinyint(3) unsigned NOT NULL,
  `crc32` int(10) unsigned NOT NULL,
  `key` text COLLATE utf8mb4_general_ci NOT NULL,
  `data` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `from_to_crc32` (`from`,`to`,`crc32`) USING BTREE,
  KEY `FK_000039` (`app_id`),
  CONSTRAINT `FK_000039` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  `user` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `phone` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pass` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `lastname` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `firstname` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `lang_id` (`lang_id`) USING BTREE,
  KEY `FK_000037` (`app_id`),
  CONSTRAINT `FK_000021` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000037` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hp_user` VALUES (1,1,1,1493439330,1493439330,1,'test','test@hotmail.com','13356966666','\$argon2i\$v=19\$m=1024,t=2,p=2\$c2NtWmdCb255NGZZUFBOLw\$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA','Helen','Alice');
";
}
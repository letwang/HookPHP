<?php
namespace Hook\Sql;

class Install
{
    const CREATE_SYS_STRUCT = "
SET FOREIGN_KEY_CHECKS = 0;
CREATE TABLE `hp_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `key` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_app_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `app_id` int(10) unsigned NOT NULL,
  `title` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `app_id` (`app_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000031` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000035` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang_i18n` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_lang_i18n` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `iso` char(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `lang` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  KEY `lang_id` (`lang_id`),
  KEY `app_id` (`app_id`),
  CONSTRAINT `FK_000034` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang_i18n` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000038` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  KEY `lang_id` (`lang_id`),
  KEY `app_id` (`app_id`),
  CONSTRAINT `FK_000021` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang_i18n` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000037` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_translation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `from` tinyint(3) unsigned NOT NULL,
  `to` tinyint(3) unsigned NOT NULL,
  `crc32` int(10) unsigned NOT NULL,
  `key` text COLLATE utf8mb4_general_ci NOT NULL,
  `data` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `from_to_crc32` (`from`,`to`,`crc32`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";
    const CREATE_SYS_DATA = "
SET FOREIGN_KEY_CHECKS = 0;
INSERT INTO `hp_app` VALUES (NULL,1,1493439330,1493439330,'iot'),(NULL,1,1493439330,1493439330,'payment'),(NULL,1,1493439330,1493439330,'store'),(NULL,1,1493439330,1493439330,'paas');
INSERT INTO `hp_app_lang` VALUES (NULL,1,1,'职能家居',''),(NULL,1,2,'支付网关',''),(NULL,1,3,'电商系统',''),(NULL,1,4,'PAAS平台',''),(NULL,2,1,'Functional home',''),(NULL,2,2,'Payment gateway',''),(NULL,2,3,'E-commerce system',''),(NULL,2,4,'PAAS platform','');
INSERT INTO `hp_lang_i18n` VALUES (NULL,1,1493439330,1493439330,'cn','zh-cn','简体中文 (简体中文)'),(NULL,1,1493439330,1493439330,'en','en-us','English (English)');
INSERT INTO `hp_user` VALUES (1,1,1,1493439330,1493439330,1,'admin','admin@hookphp.com','15902366666','\$argon2i\$v=19\$m=1024,t=2,p=2\$c2NtWmdCb255NGZZUFBOLw\$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA','Stephen','Bob');
INSERT INTO `hp_manager` VALUES (NULL,1,1,1493439330,1493439330,1,'test1','test1@hotmail.com','13356966661','\$argon2i\$v=19\$m=1024,t=2,p=2\$c2NtWmdCb255NGZZUFBOLw\$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA','Helen1','Alice1'),(NULL,1,1,1493439330,1493439330,1,'test2','test2@hotmail.com','13356966662','\$argon2i\$v=19\$m=1024,t=2,p=2\$c2NtWmdCb255NGZZUFBOLw\$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA','Helen2','Alice2'),(NULL,1,1,1493439330,1493439330,1,'test3','test3@hotmail.com','13356966663','\$argon2i\$v=19\$m=1024,t=2,p=2\$c2NtWmdCb255NGZZUFBOLw\$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA','Helen3','Alice3'),(NULL,1,1,1493439330,1493439330,1,'test4','test4@hotmail.com','13356966664','\$argon2i\$v=19\$m=1024,t=2,p=2\$c2NtWmdCb255NGZZUFBOLw\$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA','Helen4','Alice4');
";
    const CREATE_APP_STRUCT = "
SET FOREIGN_KEY_CHECKS = 0;
CREATE TABLE `hp_%s_rbac_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_rbac_group_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_lang` (`group_id`,`lang_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000012` FOREIGN KEY (`group_id`) REFERENCES `hp_%s_rbac_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000009` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang_i18n` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_rbac_group_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_role` (`group_id`,`role_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `FK_000043` FOREIGN KEY (`group_id`) REFERENCES `hp_%s_rbac_group` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000042` FOREIGN KEY (`role_id`) REFERENCES `hp_%s_rbac_role` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_rbac_group_manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `manager_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_manager` (`group_id`,`manager_id`),
  KEY `manager_id` (`manager_id`),
  CONSTRAINT `FK_000001` FOREIGN KEY (`group_id`) REFERENCES `hp_%s_rbac_group` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000002` FOREIGN KEY (`manager_id`) REFERENCES `hp_manager` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_rbac_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_rbac_role_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_lang` (`role_id`,`lang_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000014` FOREIGN KEY (`role_id`) REFERENCES `hp_%s_rbac_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000011` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang_i18n` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_rbac_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `relation_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_type_relation` (`role_id`,`type`,`relation_id`),
  CONSTRAINT `FK_000004` FOREIGN KEY (`role_id`) REFERENCES `hp_%s_rbac_role` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_rbac_manager_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `manager_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `manager_role` (`manager_id`,`role_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `FK_000008` FOREIGN KEY (`manager_id`) REFERENCES `hp_manager` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000007` FOREIGN KEY (`role_id`) REFERENCES `hp_%s_rbac_role` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `key` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_hook_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `key` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_hook_hook_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hook_id` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  `title` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hook_lang` (`hook_id`,`lang_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000015` FOREIGN KEY (`hook_id`) REFERENCES `hp_%s_hook_hook` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000016` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang_i18n` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_hook_hook_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `hook_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hook_module` (`hook_id`,`module_id`),
  KEY `module_id` (`module_id`),
  CONSTRAINT `FK_000017` FOREIGN KEY (`hook_id`) REFERENCES `hp_%s_hook_hook` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_000018` FOREIGN KEY (`module_id`) REFERENCES `hp_%s_hook_module` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_hook_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `version` varchar(8) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `key` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_element` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `key` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_element_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `element_lang` (`element_id`,`lang_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000047` FOREIGN KEY (`element_id`) REFERENCES `hp_%s_element` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000046` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang_i18n` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `parent` int(10) unsigned DEFAULT NULL,
  `url` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `icon` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `FK_000022` FOREIGN KEY (`parent`) REFERENCES `hp_%s_menu` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_menu_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_lang` (`menu_id`,`lang_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `FK_000019` FOREIGN KEY (`menu_id`) REFERENCES `hp_%s_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_000020` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang_i18n` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hp_%s_theme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  `key` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";
    const CREATE_APP_DATA = "
SET FOREIGN_KEY_CHECKS = 0;
INSERT INTO `hp_%s_rbac_group` VALUES (NULL,1,1493439330,1493439330),(NULL,1,1493439330,1493439330),(NULL,1,1493439330,1493439330),(NULL,1,1493439330,1493439330);
INSERT INTO `hp_%s_rbac_group_lang` VALUES (NULL,1,1,'董事会'),(NULL,2,1,'高层'),(NULL,3,1,'中层'),(NULL,4,1,'基层');
INSERT INTO `hp_%s_rbac_group_role` VALUES (NULL,1,1493439330,1493439330,1,1),(NULL,1,1493439330,1493439330,2,2),(NULL,1,1493439330,1493439330,3,3),(NULL,1,1493439330,1493439330,4,4);
INSERT INTO `hp_%s_rbac_group_manager` VALUES (NULL,1,1493439330,1493439330,1,1),(NULL,1,1493439330,1493439330,2,2),(NULL,1,1493439330,1493439330,3,3),(NULL,1,1493439330,1493439330,4,4);
INSERT INTO `hp_%s_rbac_role` VALUES (NULL,1,1493439330,1493439330),(NULL,1,1493439330,1493439330),(NULL,1,1493439330,1493439330),(NULL,1,1493439330,1493439330);
INSERT INTO `hp_%s_rbac_role_lang` VALUES (NULL,1,1,'管理员'),(NULL,2,1,'采购员'),(NULL,3,1,'审计员'),(NULL,4,1,'临时工');
INSERT INTO `hp_%s_rbac_permission` VALUES (NULL, 1,1493439330,1493439330, 1, 1, 1),(NULL, 1,1493439330,1493439330, 1, 1, 2),(NULL, 1,1493439330,1493439330, 1, 1, 3),(NULL, 1,1493439330,1493439330, 1, 1, 4),(NULL, 1,1493439330,1493439330, 1, 1, 5),(NULL, 1,1493439330,1493439330, 1, 1, 6),(NULL, 1,1493439330,1493439330, 1, 1, 7),(NULL, 1,1493439330,1493439330, 1, 1, 8),(NULL, 1,1493439330,1493439330, 1, 1, 9),(NULL, 1,1493439330,1493439330, 1, 1, 10),(NULL, 1,1493439330,1493439330, 1, 1, 11),(NULL, 1,1493439330,1493439330, 1, 1, 12),(NULL, 1,1493439330,1493439330, 1, 1, 13),(NULL, 1,1493439330,1493439330, 1, 1, 14),(NULL, 1,1493439330,1493439330, 1, 1, 15),(NULL, 1,1493439330,1493439330, 1, 1, 16),(NULL, 1,1493439330,1493439330, 1, 1, 17),(NULL, 1,1493439330,1493439330, 1, 1, 18),(NULL, 1,1493439330,1493439330, 1, 1, 19),(NULL, 1,1493439330,1493439330, 1, 1, 20),(NULL, 1,1493439330,1493439330, 1, 1, 21),(NULL, 1,1493439330,1493439330, 1, 1, 22),(NULL, 1,1493439330,1493439330, 1, 1, 23),(NULL, 1,1493439330,1493439330, 1, 1, 24),(NULL, 1,1493439330,1493439330, 1, 1, 25),(NULL, 1,1493439330,1493439330, 1, 2, 1),(NULL, 1,1493439330,1493439330, 2, 1, 1),(NULL, 1,1493439330,1493439330, 3, 1, 1),(NULL, 1,1493439330,1493439330, 4, 1, 1);
INSERT INTO `hp_%s_rbac_manager_role` VALUES (NULL,1,1493439330,1493439330,1,1),(NULL,1,1493439330,1493439330,1,2),(NULL,1,1493439330,1493439330,1,3),(NULL,1,1493439330,1493439330,1,4);
INSERT INTO `hp_%s_config` VALUES (NULL,1,1493439330,1493439330,'APP_LANG_NAME','zh-cn'),(NULL,1,1493439330,1493439330,'APP_THEME_NAME','default');
INSERT INTO `hp_%s_hook_hook` VALUES (NULL,1,1493439330,1493439330,0,'displayTop'),(NULL,1,1493439330,1493439330,1,'displayHead'),(NULL,1,1493439330,1493439330,2,'displayFoot');
INSERT INTO `hp_%s_hook_hook_lang` VALUES (NULL,1,1,'顶部钩子','所有顶部的钩子按顺序依次显示在这里。'),(NULL,2,1,'头部钩子','所有头部的钩子按顺序依次显示在这里。'),(NULL,3,1,'尾部钩子','所有尾部的钩子按顺序依次显示在这里。'),(NULL,1,2,'Top hook','All the top hooks are shown here in order.'),(NULL,2,2,'Head hook','The hooks of all the heads are shown here in order.'),(NULL,3,2,'Tail hook','All tail hooks are shown here in order.');
INSERT INTO `hp_%s_hook_hook_module` VALUES (NULL,1,1493439330,1493439330,0,1,1),(NULL,1,1493439330,1493439330,0,2,2),(NULL,1,1493439330,1493439330,2,3,3),(NULL,1,1493439330,1493439330,0,3,1),(NULL,1,1493439330,1493439330,1,3,2);
INSERT INTO `hp_%s_hook_module` VALUES (NULL,1,1493439330,1493439330,'0.0.1','One'),(NULL,1,1493439330,1493439330,'0.0.1','Two'),(NULL,1,1493439330,1493439330,'0.0.1','Three');
INSERT INTO `hp_%s_element` VALUES (NULL,1,1493439330,1493439330,'SHOW_FANG_DA_JING');
INSERT INTO `hp_%s_element_lang` VALUES (NULL,1,1,'显示放大镜功能');
INSERT INTO `hp_%s_menu` VALUES (NULL,1,1493439330,1493439330,1,NULL,'','people'),(NULL,1,1493439330,1493439330,0,1,'user_user',''),(NULL,1,1493439330,1493439330,2,NULL,'','grid-two-up'),(NULL,1,1493439330,1493439330,0,3,'Rbac_index',''),(NULL,1,1493439330,1493439330,0,3,'Rbac_resource',''),(NULL,1,1493439330,1493439330,0,3,'Rbac_role',''),(NULL,1,1493439330,1493439330,0,3,'Rbac_user',''),(NULL,1,1493439330,1493439330,0,3,'Rbac_group',''),(NULL,1,1493439330,1493439330,3,NULL,'','bar-chart'),(NULL,1,1493439330,1493439330,0,9,'config',''),(NULL,1,1493439330,1493439330,4,NULL,'','list-rich'),(NULL,1,1493439330,1493439330,0,11,'translation',''),(NULL,1,1493439330,1493439330,5,NULL,'','wrench'),(NULL,1,1493439330,1493439330,0,13,'manager',''),(NULL,1,1493439330,1493439330,6,NULL,'','browser'),(NULL,1,1493439330,1493439330,0,15,'menu',''),(NULL,1,1493439330,1493439330,7,NULL,'','infinity'),(NULL,1,1493439330,1493439330,0,17,'lang',''),(NULL,1,1493439330,1493439330,8,NULL,'','media-skip-backward'),(NULL,1,1493439330,1493439330,0,19,'hook_hook',''),(NULL,1,1493439330,1493439330,0,19,'hook_module',''),(NULL,1,1493439330,1493439330,9,NULL,'','resize-both'),(NULL,1,1493439330,1493439330,0,22,'theme',''),(NULL,1,1493439330,1493439330,10,NULL,'','calendar'),(NULL,1,1493439330,1493439330,0,24,'app','');
INSERT INTO `hp_%s_menu_lang` VALUES (NULL,1,1,'用户管理'),(NULL,2,1,'用户'),(NULL,1,3,'权限管理'),(NULL,4,1,'权限'),(NULL,5,1,'资源'),(NULL,6,1,'角色'),(NULL,7,1,'用户'),(NULL,8,1,'分组'),(NULL,9,1,'配置管理'),(NULL,10,1,'配置'),(NULL,11,1,'翻译管理'),(NULL,12,1,'翻译'),(NULL,13,1,'超管管理'),(NULL,14,1,'超级管理员'),(NULL,15,1,'菜单管理'),(NULL,16,1,'菜单'),(NULL,17,1,'语言管理'),(NULL,18,1,'语言'),(NULL,19,1,'模块管理'),(NULL,20,1,'钩子'),(NULL,21,1,'模块'),(NULL,22,1,'模板管理'),(NULL,23,1,'模板'),(NULL,24,1,'平台管理'),(NULL,25,1,'平台'),(NULL,1,2,'User Management'),(NULL,2,2,'User'),(NULL,3,2,'Permission management'),(NULL,4,2,'Permission'),(NULL,5,2,'Resource'),(NULL,6,2,'Character'),(NULL,7,2,'user'),(NULL,8,2,'Grouping'),(NULL,9,2,'Configuration management'),(NULL,10,2,'Configuration'),(NULL,11,2,'Translation management'),(NULL,12,2,'Translation'),(NULL,13,2,'Super management'),(NULL,14,2,'Super administrator'),(NULL,15,2,'Menu management'),(NULL,16,2,'Menu'),(NULL,17,2,'Language management'),(NULL,18,2,'Language'),(NULL,19,2,'Module management'),(NULL,20,2,'hook'),(NULL,21,2,'Module'),(NULL,22,2,'Template management'),(NULL,23,2,'Template'),(NULL,24,2,'Platform management'),(NULL,25,2,'Platform');
INSERT INTO `hp_%s_theme` VALUES (NULL,1,1493439330,1493439330,'default'),(NULL,1,1493439330,1493439330,'winner');
";
}
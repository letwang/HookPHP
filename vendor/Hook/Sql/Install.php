<?php
namespace Hook\Sql;

class Install
{

    const SQL_TABLES = "
CREATE TABLE IF NOT EXISTS `hp_acl_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_acl_group` (`id`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_acl_group_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `name` char(32) NOT NULL,
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`lang_id`) USING BTREE,
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_acl_group_lang` (`id`, `lang_id`, `group_id`, `name`, `date_add`, `date_upd`) VALUES
(1, 1, 1, '华东地区订单授权', 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_acl_group_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`resource_id`),
  KEY `resource_id` (`resource_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `hp_acl_group_resource` (`id`, `group_id`, `resource_id`, `status`, `date_add`) VALUES
(1, 1, 1, 1, 1493439330),
(2, 1, 2, 1, 1493439330),
(3, 1, 3, 1, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_acl_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `module` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `controller` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `action` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `AMCA` (`app`,`module`,`controller`,`action`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `hp_acl_resource` (`id`, `app`, `module`, `controller`, `action`, `status`, `date_add`, `date_upd`) VALUES
(1, 'store', 'order', 'list', 'view', 1, 1493439330, 1493439330),
(2, 'store', 'order', 'refund', 'edit', 1, 1493439330, 1493439330),
(3, 'store', 'order', 'detail', 'delete', 1, 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_acl_resource_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `name` char(32) NOT NULL,
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resource_id` (`resource_id`,`lang_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `hp_acl_resource_lang` (`id`, `lang_id`, `resource_id`, `name`, `date_add`, `date_upd`) VALUES
(1, 1, 1, '订单列表查看', 1493439330, 1493439330),
(2, 1, 2, '订单退货编辑', 1493439330, 1493439330),
(3, 1, 3, '订单详情删除', 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_acl_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `hp_acl_role` (`id`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, 1493439330, 1493439330),
(2, 1, 1493439330, 1493439330),
(3, 1, 1493439330, 1493439330),
(4, 1, 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_acl_role_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `name` char(32) NOT NULL,
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`role_id`,`lang_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `hp_acl_role_lang` (`id`, `lang_id`, `role_id`, `name`, `date_add`, `date_upd`) VALUES
(1, 1, 1, '江苏办总经理', 1493439330, 1493439330),
(2, 1, 2, '上海办总经理', 1493439330, 1493439330),
(3, 1, 3, '昆山办经理', 1493439330, 1493439330),
(4, 1, 4, '苏州办总经理', 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_acl_role_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`role_id`,`resource_id`),
  KEY `resource_id` (`resource_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

INSERT INTO `hp_acl_role_resource` (`id`, `role_id`, `resource_id`, `status`, `date_add`) VALUES
(1, 1, 1, 1, 1493439330),
(2, 1, 2, 1, 1493439330),
(3, 1, 3, 1, 1493439330),
(4, 2, 3, 1, 1493439330),
(5, 3, 2, 1, 1493439330),
(6, 4, 3, 1, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_acl_user_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`resource_id`),
  KEY `resource_id` (`resource_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_acl_user_resource` (`id`, `user_id`, `resource_id`, `status`, `date_add`) VALUES
(1, 1, 3, 1, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_acl_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `hp_acl_user_role` (`id`, `user_id`, `role_id`, `status`, `date_add`) VALUES
(1, 1, 1, 1, 1493439330),
(2, 1, 2, 1, 1493439330),
(3, 1, 3, 1, 1493439330),
(4, 1, 4, 1, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` varchar(255) NOT NULL,
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_config` (`id`, `key`, `value`, `date_add`, `date_upd`) VALUES
(1, 'HP_LANG_DEFAULT', '1', 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `hp_hook` (`id`, `key`, `position`, `date_add`, `date_upd`) VALUES
(1, 'displayTop', 0, 1493439330, 1493439330),
(2, 'displayHead', 1, 1493439330, 1493439330),
(3, 'displayFoot', 2, 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_hook_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hook_id` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  `name` char(32) NOT NULL DEFAULT '',
  `title` char(64) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hook_id` (`hook_id`,`lang_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_hook_lang` (`id`, `hook_id`, `lang_id`, `name`, `title`, `description`, `date_add`, `date_upd`) VALUES
(1, 1, 1, '头部钩子', '这里显示头部的钩子', '所有头部的钩子按顺序依次显示在这里。', 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_hook_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hook_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `FK_000017` (`hook_id`,`module_id`) USING BTREE,
  KEY `FK_000018` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_hook_module` (`id`, `hook_id`, `module_id`, `position`, `date_add`, `date_upd`) VALUES
(1, 1, 1, 0, 1493439330, 1493439330),
(2, 2, 2, 0, 1493439330, 1493439330),
(3, 3, 3, 2, 1493439330, 1493439330),
(4, 3, 1, 0, 1493439330, 1493439330),
(5, 3, 2, 1, 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `iso_code` char(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `language_code` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `hp_lang` (`id`, `name`, `iso_code`, `language_code`, `status`, `date_add`, `date_upd`) VALUES
(1, '简体中文 (简体中文)', 'cn', 'zh-cn', 1, 1493439330, 1493439330),
(2, 'English (English)', 'en', 'en-us', 1, 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(10) unsigned DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  `class` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `icon` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

INSERT INTO `hp_menu` (`id`, `parent`, `status`, `position`, `class`, `icon`, `date_add`, `date_upd`) VALUES
(1, 16, 1, 0, 'AdminAclGroup', 'order', 1493439330, 1493439330),
(2, 16, 1, 0, 'AdminAclResource', 'order', 1493439330, 1493439330),
(3, 16, 1, 0, 'AdminAclRole', 'order', 1493439330, 1493439330),
(4, 16, 1, 0, 'AdminAclUser', 'order', 1493439330, 1493439330),
(5, NULL, 1, 0, 'AdminConfig', 'order', 1493439330, 1493439330),
(6, NULL, 1, 0, 'AdminHook', 'order', 1493439330, 1493439330),
(7, NULL, 1, 0, 'AdminLang', 'order', 1493439330, 1493439330),
(8, NULL, 1, 0, 'AdminManager', 'order', 1493439330, 1493439330),
(9, NULL, 1, 0, 'AdminMenu', 'order', 1493439330, 1493439330),
(10, NULL, 1, 0, 'AdminModule', 'order', 1493439330, 1493439330),
(11, NULL, 1, 0, 'AdminTranslation', 'order', 1493439330, 1493439330),
(12, NULL, 1, 0, 'AdminUser', 'order', 1493439330, 1493439330),
(13, 12, 1, 0, 'AdminUserBrowser', 'order', 1493439330, 1493439330),
(14, 12, 1, 0, 'AdminUserGuest', 'order', 1493439330, 1493439330),
(15, 12, 1, 0, 'AdminUserSystem', 'order', 1493439330, 1493439330),
(16, NULL, 1, 0, 'AdminAcl', 'order', 1493439330, 1493439330),
(17, NULL, 1, 0, 'AdminTheme', 'order', 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_menu_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  `name` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_000019` (`menu_id`,`lang_id`) USING BTREE,
  KEY `FK_000020` (`lang_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

INSERT INTO `hp_menu_lang` (`id`, `menu_id`, `lang_id`, `name`, `date_add`, `date_upd`) VALUES
(1, 1, 1, '用户组', 1493439330, 1493439330),
(2, 2, 1, '资源', 1493439330, 1493439330),
(3, 3, 1, '角色', 1493439330, 1493439330),
(4, 4, 1, '用户', 1493439330, 1493439330),
(5, 5, 1, '配置', 1493439330, 1493439330),
(6, 6, 1, '组件', 1493439330, 1493439330),
(7, 7, 1, '语言', 1493439330, 1493439330),
(8, 8, 1, '管理员', 1493439330, 1493439330),
(9, 9, 1, '菜单', 1493439330, 1493439330),
(10, 10, 1, '模块', 1493439330, 1493439330),
(11, 11, 1, '翻译', 1493439330, 1493439330),
(12, 12, 1, '用户', 1493439330, 1493439330),
(13, 13, 1, '浏览器', 1493439330, 1493439330),
(14, 14, 1, '访客', 1493439330, 1493439330),
(15, 15, 1, '系统', 1493439330, 1493439330),
(16, 16, 1, '权限', 1493439330, 1493439330),
(17, 17, 1, '模板', 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `version` char(8) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_module` (`id`, `key`, `version`, `status`, `date_add`, `date_upd`) VALUES
(1, 'One', '0.0.1', 1, 1493439330, 1493439330),
(2, 'Two', '0.0.1', 1, 1493439330, 1493439330),
(3, 'Three', '0.0.1', 1, 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned DEFAULT NULL,
  `user` char(64) NOT NULL,
  `pass` char(95) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` char(64) NOT NULL DEFAULT '',
  `phone` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lastname` char(16) NOT NULL DEFAULT '',
  `firstname` char(16) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang_id` (`lang_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_user` (`id`, `lang_id`, `user`, `pass`, `email`, `phone`, `lastname`, `firstname`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, 'test@hotmail.com', '\$argon2i\$v=19\$m=1024,t=2,p=2\$c2NtWmdCb255NGZZUFBOLw\$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA', '', '', 'bobstephen', '', 1, 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned DEFAULT NULL,
  `user` char(64) NOT NULL,
  `pass` char(95) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` char(64) NOT NULL DEFAULT '',
  `phone` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lastname` char(16) NOT NULL DEFAULT '',
  `firstname` char(16) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `date_add` int(10) unsigned NOT NULL,
  `date_upd` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang_id` (`lang_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_manager` (`id`, `lang_id`, `user`, `pass`, `email`, `phone`, `lastname`, `firstname`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, 'admin@hookphp.com', '\$argon2i\$v=19\$m=1024,t=2,p=2\$c2NtWmdCb255NGZZUFBOLw\$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA', '', '', 'bobstephen', '', 1, 1493439330, 1493439330);

CREATE TABLE IF NOT EXISTS `hp_user_browser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

INSERT INTO `hp_user_browser` (`id`, `name`) VALUES
(1, 'Safari'),
(2, 'Safari iPad'),
(3, 'Firefox'),
(4, 'Opera'),
(5, 'IE 6'),
(6, 'IE 7'),
(7, 'IE 8'),
(8, 'IE 9'),
(9, 'IE 10'),
(10, 'IE 11'),
(11, 'Chrome');

CREATE TABLE IF NOT EXISTS `hp_user_guest` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `system_id` int(10) unsigned DEFAULT NULL,
  `browser_id` int(10) unsigned DEFAULT NULL,
  `javascript` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `screen_resolution_x` smallint(5) unsigned NOT NULL DEFAULT '0',
  `screen_resolution_y` smallint(5) unsigned NOT NULL DEFAULT '0',
  `screen_color` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sun_java` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `adobe_flash` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `adobe_director` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `apple_quicktime` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `real_player` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `windows_media` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_add` int(10) unsigned NOT NULL,
  `language` char(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `browser_id` (`browser_id`) USING BTREE,
  KEY `system_id` (`system_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_user_guest` (`id`, `user_id`, `system_id`, `browser_id`, `javascript`, `screen_resolution_x`, `screen_resolution_y`, `screen_color`, `sun_java`, `adobe_flash`, `adobe_director`, `apple_quicktime`, `real_player`, `windows_media`, `mobile`, `date_add`, `language`) VALUES
(1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '');

CREATE TABLE IF NOT EXISTS `hp_user_system` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

INSERT INTO `hp_user_system` (`id`, `name`) VALUES
(1, 'Windows XP'),
(2, 'Windows Vista'),
(3, 'Windows 7'),
(4, 'Windows 8'),
(5, 'Windows 8.1'),
(6, 'Windows 10'),
(7, 'MacOsX'),
(8, 'Linux'),
(9, 'Android');

CREATE TABLE IF NOT EXISTS `hp_translation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_lang_from` tinyint(3) unsigned NOT NULL,
  `id_lang_to` tinyint(3) unsigned NOT NULL,
  `key_crc32` int(11) unsigned NOT NULL,
  `key` text NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_lang_from_id_lang_to_key_crc32` (`id_lang_from`,`id_lang_to`,`key_crc32`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `hp_acl_group_lang`
  ADD CONSTRAINT `FK_000009` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000012` FOREIGN KEY (`group_id`) REFERENCES `hp_acl_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_acl_group_resource`
  ADD CONSTRAINT `FK_000001` FOREIGN KEY (`group_id`) REFERENCES `hp_acl_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000002` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_acl_resource_lang`
  ADD CONSTRAINT `FK_000010` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000013` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_acl_role_lang`
  ADD CONSTRAINT `FK_000011` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000014` FOREIGN KEY (`role_id`) REFERENCES `hp_acl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_acl_role_resource`
  ADD CONSTRAINT `FK_000003` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000004` FOREIGN KEY (`role_id`) REFERENCES `hp_acl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_acl_user_resource`
  ADD CONSTRAINT `FK_000005` FOREIGN KEY (`user_id`) REFERENCES `hp_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000006` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_acl_user_role`
  ADD CONSTRAINT `FK_000007` FOREIGN KEY (`role_id`) REFERENCES `hp_acl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000008` FOREIGN KEY (`user_id`) REFERENCES `hp_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_hook_lang`
  ADD CONSTRAINT `FK_000015` FOREIGN KEY (`hook_id`) REFERENCES `hp_hook` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000016` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_hook_module`
  ADD CONSTRAINT `FK_000017` FOREIGN KEY (`hook_id`) REFERENCES `hp_hook` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000018` FOREIGN KEY (`module_id`) REFERENCES `hp_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_menu`
  ADD CONSTRAINT `FK_000022` FOREIGN KEY (`parent`) REFERENCES `hp_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_menu_lang`
  ADD CONSTRAINT `FK_000019` FOREIGN KEY (`menu_id`) REFERENCES `hp_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000020` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_user`
  ADD CONSTRAINT `FK_000021` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `hp_user_guest`
  ADD CONSTRAINT `FK_000023` FOREIGN KEY (`user_id`) REFERENCES `hp_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000024` FOREIGN KEY (`system_id`) REFERENCES `hp_user_system` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000025` FOREIGN KEY (`browser_id`) REFERENCES `hp_user_browser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
";
}
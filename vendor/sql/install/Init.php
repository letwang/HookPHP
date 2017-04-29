<?php
namespace Install\Init;

class Mysql
{

    const base = "
CREATE TABLE IF NOT EXISTS `hp_acl_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_acl_group` (`id`, `status`) VALUES
(1, 1);

CREATE TABLE IF NOT EXISTS `hp_acl_group_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `name` char(16) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`lang_id`) USING BTREE,
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_acl_group_lang` (`id`, `lang_id`, `group_id`, `name`) VALUES
(1, 1, 1, '华东地区订单授权');

CREATE TABLE IF NOT EXISTS `hp_acl_group_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`resource_id`),
  KEY `resource_id` (`resource_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `hp_acl_group_resource` (`id`, `group_id`, `resource_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1);

CREATE TABLE IF NOT EXISTS `hp_acl_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `module` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `controller` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `action` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `AMCA` (`app`,`module`,`controller`,`action`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `hp_acl_resource` (`id`, `app`, `module`, `controller`, `action`, `status`) VALUES
(1, 'store', 'order', 'list', 'view', 1),
(2, 'store', 'order', 'refund', 'edit', 1),
(3, 'store', 'order', 'detail', 'delete', 1);

CREATE TABLE IF NOT EXISTS `hp_acl_resource_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `name` char(16) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resource_id` (`resource_id`,`lang_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `hp_acl_resource_lang` (`id`, `lang_id`, `resource_id`, `name`) VALUES
(1, 1, 1, '订单列表查看'),
(2, 1, 2, '订单退货编辑'),
(3, 1, 3, '订单详情删除');

CREATE TABLE IF NOT EXISTS `hp_acl_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `hp_acl_role` (`id`, `status`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

CREATE TABLE IF NOT EXISTS `hp_acl_role_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `name` char(16) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`role_id`,`lang_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `hp_acl_role_lang` (`id`, `lang_id`, `role_id`, `name`) VALUES
(1, 1, 1, '江苏办总经理'),
(2, 1, 2, '上海办总经理'),
(3, 1, 3, '昆山办经理'),
(4, 1, 4, '苏州办总经理');

CREATE TABLE IF NOT EXISTS `hp_acl_role_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`role_id`,`resource_id`),
  KEY `resource_id` (`resource_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

INSERT INTO `hp_acl_role_resource` (`id`, `role_id`, `resource_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 2, 3, 1),
(5, 3, 2, 1),
(6, 4, 3, 1);

CREATE TABLE IF NOT EXISTS `hp_acl_user_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`resource_id`),
  KEY `resource_id` (`resource_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_acl_user_resource` (`id`, `user_id`, `resource_id`, `status`) VALUES
(1, 1, 3, 1);

CREATE TABLE IF NOT EXISTS `hp_acl_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `hp_acl_user_role` (`id`, `user_id`, `role_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1);

CREATE TABLE IF NOT EXISTS `hp_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_config` (`id`, `key`, `value`) VALUES
(1, 'HP_LANG_DEFAULT', '1');

CREATE TABLE IF NOT EXISTS `hp_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `iso_code` char(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `language_code` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `hp_lang` (`id`, `name`, `iso_code`, `language_code`, `status`) VALUES
(1, '简体中文 (简体中文)', 'cn', 'zh-cn', 1),
(2, 'English (English)', 'en', 'en-us', 1);

CREATE TABLE IF NOT EXISTS `hp_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` char(64) NOT NULL,
  `pass` char(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `name` char(16) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `hp_user` (`id`, `user`, `pass`, `name`, `status`) VALUES
(1, 'admin@hookphp.com', '6abedafaed3f1d50eb07a087d5a93d15de821702dbb4c4fcc136cb69ae05f9a6', 'bobstephen', 1);


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
";

    const translation = 'CREATE TABLE IF NOT EXISTS `translation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_lang_from` tinyint(3) unsigned NOT NULL,
  `id_lang_to` tinyint(3) unsigned NOT NULL,
  `key_crc32` int(11) unsigned NOT NULL,
  `key` text NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_lang_from_id_lang_to_key_crc32` (`id_lang_from`,`id_lang_to`,`key_crc32`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;';
}

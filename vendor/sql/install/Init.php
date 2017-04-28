<?php
namespace Install\Init;

class Mysql
{

    const base = "
CREATE TABLE `hp_acl_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_acl_group` (`id`, `type`, `status`) VALUES
(1, 0, 1);

CREATE TABLE `hp_acl_group_lang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_lang` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `name` char(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_acl_group_lang` (`id`, `id_lang`, `name`) VALUES
(1, 1, '客户端资源列表');

CREATE TABLE `hp_acl_group_resource` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `resource_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_acl_group_resource` (`id`, `group_id`, `resource_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1);

CREATE TABLE `hp_acl_resource` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_acl_resource` (`id`, `status`) VALUES
(1, 1),
(2, 1),
(3, 1);

CREATE TABLE `hp_acl_resource_lang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_lang` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `name` char(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_acl_resource_lang` (`id`, `id_lang`, `name`) VALUES
(1, 1, '用户删除'),
(2, 1, '订单修改'),
(3, 1, '用户查看');

CREATE TABLE `hp_acl_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_acl_role` (`id`, `status`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

CREATE TABLE `hp_acl_role_lang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_lang` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `name` char(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_acl_role_lang` (`id`, `id_lang`, `name`) VALUES
(1, 1, '管理员'),
(2, 1, '会计'),
(3, 1, '销售'),
(4, 1, '研发');

CREATE TABLE `hp_acl_role_resource` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `resource_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_acl_role_resource` (`id`, `role_id`, `resource_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 2, 3, 1),
(5, 3, 2, 1),
(6, 4, 3, 1);

CREATE TABLE `hp_acl_user_resource` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `resource_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_acl_user_resource` (`id`, `user_id`, `resource_id`, `status`) VALUES
(1, 1, 3, 1);

CREATE TABLE `hp_acl_user_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_acl_user_role` (`id`, `user_id`, `role_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1);

CREATE TABLE `hp_lang` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(32) NOT NULL,
  `iso_code` char(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `language_code` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_lang` (`id`, `name`, `iso_code`, `language_code`, `status`) VALUES
(1, '简体中文 (简体中文)', 'cn', 'zh-cn', 1),
(2, 'English (English)', 'en', 'en-us', 1);

CREATE TABLE `hp_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` char(64) NOT NULL,
  `pass` char(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `name` char(16) NOT NULL DEFAULT '',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_user` (`id`, `user`, `pass`, `name`, `status`) VALUES
(1, 'admin@hookphp.com', '6abedafaed3f1d50eb07a087d5a93d15de821702dbb4c4fcc136cb69ae05f9a6', 'bobstephen', 1);


ALTER TABLE `hp_acl_group`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `hp_acl_group_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lang` (`id_lang`);

ALTER TABLE `hp_acl_group_resource`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_id` (`group_id`,`resource_id`),
  ADD KEY `resource_id` (`resource_id`);

ALTER TABLE `hp_acl_resource`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `hp_acl_resource_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lang` (`id_lang`);

ALTER TABLE `hp_acl_role`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `hp_acl_role_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lang` (`id_lang`);

ALTER TABLE `hp_acl_role_resource`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_id` (`role_id`,`resource_id`),
  ADD KEY `resource_id` (`resource_id`);

ALTER TABLE `hp_acl_user_resource`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`resource_id`),
  ADD KEY `resource_id` (`resource_id`);

ALTER TABLE `hp_acl_user_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

ALTER TABLE `hp_lang`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `hp_user`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `hp_acl_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `hp_acl_group_lang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `hp_acl_group_resource`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `hp_acl_resource`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `hp_acl_resource_lang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `hp_acl_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `hp_acl_role_lang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `hp_acl_role_resource`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `hp_acl_user_resource`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `hp_acl_user_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `hp_lang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `hp_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `hp_acl_group_lang`
  ADD CONSTRAINT `FK_000009` FOREIGN KEY (`id_lang`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_acl_group_resource`
  ADD CONSTRAINT `FK_000001` FOREIGN KEY (`group_id`) REFERENCES `hp_acl_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000002` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_acl_resource_lang`
  ADD CONSTRAINT `FK_000010` FOREIGN KEY (`id_lang`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `hp_acl_role_lang`
  ADD CONSTRAINT `FK_000011` FOREIGN KEY (`id_lang`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

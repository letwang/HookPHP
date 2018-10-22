<?php
namespace Hook\Sql;

class Install
{

    const SQL_TABLES = "
--
-- Table structure for table `hp_acl_group`
--

CREATE TABLE `hp_acl_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_acl_group`
--

INSERT INTO `hp_acl_group` (`id`, `app_id`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, 1, 1493439330, 1493439330);

-- --------------------------------------------------------

--
-- Table structure for table `hp_acl_group_lang`
--

CREATE TABLE `hp_acl_group_lang` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `name` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_acl_group_lang`
--

INSERT INTO `hp_acl_group_lang` (`id`, `lang_id`, `group_id`, `date_add`, `date_upd`, `name`) VALUES
(1, 1, 1, 1493439330, 1493439330, '华东地区订单授权');

-- --------------------------------------------------------

--
-- Table structure for table `hp_acl_group_resource`
--

CREATE TABLE `hp_acl_group_resource` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `resource_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_acl_group_resource`
--

INSERT INTO `hp_acl_group_resource` (`id`, `group_id`, `resource_id`, `status`, `date_add`) VALUES
(1, 1, 1, 1, 1493439330),
(2, 1, 2, 1, 1493439330),
(3, 1, 3, 1, 1493439330);

-- --------------------------------------------------------

--
-- Table structure for table `hp_acl_resource`
--

CREATE TABLE `hp_acl_resource` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `app` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `module` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `controller` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `action` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_acl_resource`
--

INSERT INTO `hp_acl_resource` (`id`, `app_id`, `status`, `date_add`, `date_upd`, `app`, `module`, `controller`, `action`) VALUES
(1, 1, 1, 1493439330, 1493439330, 'store', 'order', 'list', 'view'),
(2, 1, 1, 1493439330, 1493439330, 'store', 'order', 'refund', 'edit'),
(3, 1, 1, 1493439330, 1493439330, 'store', 'order', 'detail', 'delete');

-- --------------------------------------------------------

--
-- Table structure for table `hp_acl_resource_lang`
--

CREATE TABLE `hp_acl_resource_lang` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL,
  `resource_id` int(10) UNSIGNED NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `name` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_acl_resource_lang`
--

INSERT INTO `hp_acl_resource_lang` (`id`, `lang_id`, `resource_id`, `date_add`, `date_upd`, `name`) VALUES
(1, 1, 1, 1493439330, 1493439330, '订单列表查看'),
(2, 1, 2, 1493439330, 1493439330, '订单退货编辑'),
(3, 1, 3, 1493439330, 1493439330, '订单详情删除');

-- --------------------------------------------------------

--
-- Table structure for table `hp_acl_role`
--

CREATE TABLE `hp_acl_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_acl_role`
--

INSERT INTO `hp_acl_role` (`id`, `app_id`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, 1, 1493439330, 1493439330),
(2, 1, 1, 1493439330, 1493439330),
(3, 1, 1, 1493439330, 1493439330),
(4, 1, 1, 1493439330, 1493439330);

-- --------------------------------------------------------

--
-- Table structure for table `hp_acl_role_lang`
--

CREATE TABLE `hp_acl_role_lang` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `name` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_acl_role_lang`
--

INSERT INTO `hp_acl_role_lang` (`id`, `lang_id`, `role_id`, `date_add`, `date_upd`, `name`) VALUES
(1, 1, 1, 1493439330, 1493439330, '江苏办总经理'),
(2, 1, 2, 1493439330, 1493439330, '上海办总经理'),
(3, 1, 3, 1493439330, 1493439330, '昆山办经理'),
(4, 1, 4, 1493439330, 1493439330, '苏州办总经理');

-- --------------------------------------------------------

--
-- Table structure for table `hp_acl_role_resource`
--

CREATE TABLE `hp_acl_role_resource` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `resource_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_acl_role_resource`
--

INSERT INTO `hp_acl_role_resource` (`id`, `role_id`, `resource_id`, `status`, `date_add`) VALUES
(1, 1, 1, 1, 1493439330),
(2, 1, 2, 1, 1493439330),
(3, 1, 3, 1, 1493439330),
(4, 2, 3, 1, 1493439330),
(5, 3, 2, 1, 1493439330),
(6, 4, 3, 1, 1493439330);

-- --------------------------------------------------------

--
-- Table structure for table `hp_acl_user_resource`
--

CREATE TABLE `hp_acl_user_resource` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `resource_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_acl_user_resource`
--

INSERT INTO `hp_acl_user_resource` (`id`, `user_id`, `resource_id`, `status`, `date_add`) VALUES
(1, 1, 3, 1, 1493439330);

-- --------------------------------------------------------

--
-- Table structure for table `hp_acl_user_role`
--

CREATE TABLE `hp_acl_user_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_acl_user_role`
--

INSERT INTO `hp_acl_user_role` (`id`, `user_id`, `role_id`, `status`, `date_add`) VALUES
(1, 1, 1, 1, 1493439330),
(2, 1, 2, 1, 1493439330),
(3, 1, 3, 1, 1493439330),
(4, 1, 4, 1, 1493439330);

-- --------------------------------------------------------

--
-- Table structure for table `hp_app`
--

CREATE TABLE `hp_app` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `name` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hp_app`
--

INSERT INTO `hp_app` (`id`, `status`, `date_add`, `date_upd`, `name`, `description`) VALUES
(1, 1, 1493439330, 1493439330, 'admin', '平台中控系统，统一管理各大平台'),
(2, 1, 1493439330, 1493439330, 'erp', 'ERP系统'),
(3, 1, 1493439330, 1493439330, 'paas', 'PAAS系统');

-- --------------------------------------------------------

--
-- Table structure for table `hp_app_lang`
--

CREATE TABLE `hp_app_lang` (
  `id` int(11) NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hp_app_lang`
--

INSERT INTO `hp_app_lang` (`id`, `app_id`, `lang_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hp_config`
--

CREATE TABLE `hp_config` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `name` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_config`
--

INSERT INTO `hp_config` (`id`, `app_id`, `date_add`, `date_upd`, `name`, `value`) VALUES
(1, 1, 1493439330, 1493439330, 'HP_LANG_DEFAULT', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hp_hook`
--

CREATE TABLE `hp_hook` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `position` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `name` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_hook`
--

INSERT INTO `hp_hook` (`id`, `app_id`, `position`, `date_add`, `date_upd`, `name`) VALUES
(1, 1, 0, 1493439330, 1493439330, 'displayTop'),
(2, 1, 1, 1493439330, 1493439330, 'displayHead'),
(3, 1, 2, 1493439330, 1493439330, 'displayFoot');

-- --------------------------------------------------------

--
-- Table structure for table `hp_hook_lang`
--

CREATE TABLE `hp_hook_lang` (
  `id` int(10) UNSIGNED NOT NULL,
  `hook_id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `name` char(32) NOT NULL DEFAULT '',
  `title` char(64) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_hook_lang`
--

INSERT INTO `hp_hook_lang` (`id`, `hook_id`, `lang_id`, `date_add`, `date_upd`, `name`, `title`, `description`) VALUES
(1, 1, 1, 1493439330, 1493439330, '头部钩子', '这里显示头部的钩子', '所有头部的钩子按顺序依次显示在这里。');

-- --------------------------------------------------------

--
-- Table structure for table `hp_hook_module`
--

CREATE TABLE `hp_hook_module` (
  `id` int(10) UNSIGNED NOT NULL,
  `hook_id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `position` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_hook_module`
--

INSERT INTO `hp_hook_module` (`id`, `hook_id`, `module_id`, `position`, `date_add`, `date_upd`) VALUES
(1, 1, 1, 0, 1493439330, 1493439330),
(2, 2, 2, 0, 1493439330, 1493439330),
(3, 3, 3, 2, 1493439330, 1493439330),
(4, 3, 1, 0, 1493439330, 1493439330),
(5, 3, 2, 1, 1493439330, 1493439330);

-- --------------------------------------------------------

--
-- Table structure for table `hp_lang`
--

CREATE TABLE `hp_lang` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `iso` char(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `lang` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `name` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_lang`
--

INSERT INTO `hp_lang` (`id`, `status`, `date_add`, `date_upd`, `iso`, `lang`, `name`) VALUES
(1, 1, 1493439330, 1493439330, 'cn', 'zh-cn', '简体中文 (简体中文)'),
(2, 1, 1493439330, 1493439330, 'en', 'en-us', 'English (English)');

-- --------------------------------------------------------

--
-- Table structure for table `hp_manager`
--

CREATE TABLE `hp_manager` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `user` char(64) NOT NULL,
  `pass` char(95) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` char(64) NOT NULL DEFAULT '',
  `phone` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lastname` char(16) NOT NULL DEFAULT '',
  `firstname` char(16) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_manager`
--

INSERT INTO `hp_manager` (`id`, `lang_id`, `status`, `date_add`, `date_upd`, `user`, `pass`, `email`, `phone`, `lastname`, `firstname`) VALUES
(1, 1, 1, 1493439330, 1493439330, 'admin@hookphp.com', '$argon2i$v=19$m=1024,t=2,p=2$c2NtWmdCb255NGZZUFBOLw$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA', '', '', 'bobstephen', '');

-- --------------------------------------------------------

--
-- Table structure for table `hp_menu`
--

CREATE TABLE `hp_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `url` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `icon` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hp_menu`
--

INSERT INTO `hp_menu` (`id`, `app_id`, `parent`, `status`, `position`, `date_add`, `date_upd`, `url`, `icon`) VALUES
(1, 1, NULL, 1, 1, 1493439330, 1493439330, '', 'people'),
(2, 1, 1, 1, 0, 1493439330, 1493439330, 'user_index', ''),
(3, 1, NULL, 1, 2, 1493439330, 1493439330, '', 'grid-two-up'),
(4, 1, 3, 1, 0, 1493439330, 1493439330, 'acl_index', ''),
(5, 1, 3, 1, 0, 1493439330, 1493439330, 'acl_resource', ''),
(6, 1, 3, 1, 0, 1493439330, 1493439330, 'acl_role', ''),
(7, 1, 3, 1, 0, 1493439330, 1493439330, 'acl_user', ''),
(8, 1, 3, 1, 0, 1493439330, 1493439330, 'acl_group', ''),
(9, 1, NULL, 1, 3, 1493439330, 1493439330, '', 'bar-chart'),
(10, 1, 9, 1, 0, 1493439330, 1493439330, 'config', ''),
(11, 1, NULL, 1, 4, 1493439330, 1493439330, '', 'list-rich'),
(12, 1, 11, 1, 0, 1493439330, 1493439330, 'translation', ''),
(13, 1, NULL, 1, 5, 1493439330, 1493439330, '', 'wrench'),
(14, 1, 13, 1, 0, 1493439330, 1493439330, 'manager', ''),
(15, 1, NULL, 1, 6, 1493439330, 1493439330, '', 'browser'),
(16, 1, 15, 1, 0, 1493439330, 1493439330, 'menu', ''),
(17, 1, NULL, 1, 7, 1493439330, 1493439330, '', 'infinity'),
(18, 1, 17, 1, 0, 1493439330, 1493439330, 'lang', ''),
(19, 1, NULL, 1, 8, 1493439330, 1493439330, '', 'media-skip-backward'),
(20, 1, 19, 1, 0, 1493439330, 1493439330, 'hook_index', ''),
(21, 1, 19, 1, 0, 1493439330, 1493439330, 'hook_module', ''),
(22, 1, NULL, 1, 9, 1493439330, 1493439330, '', 'resize-both'),
(23, 1, 22, 1, 0, 1493439330, 1493439330, 'theme', ''),
(24, 1, NULL, 1, 10, 1493439330, 1493439330, '', 'calendar'),
(25, 1, 24, 1, 0, 1493439330, 1493439330, 'platform', '');

-- --------------------------------------------------------

--
-- Table structure for table `hp_menu_lang`
--

CREATE TABLE `hp_menu_lang` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `name` char(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hp_menu_lang`
--

INSERT INTO `hp_menu_lang` (`id`, `menu_id`, `lang_id`, `date_add`, `date_upd`, `name`) VALUES
(1, 1, 1, 1493439330, 1493439330, '用户管理'),
(2, 2, 1, 1493439330, 1493439330, '用户'),
(3, 3, 1, 1493439330, 1493439330, '权限管理'),
(4, 4, 1, 1493439330, 1493439330, '权限'),
(5, 5, 1, 1493439330, 1493439330, '资源'),
(6, 6, 1, 1493439330, 1493439330, '角色'),
(7, 7, 1, 1493439330, 1493439330, '用户'),
(8, 8, 1, 1493439330, 1493439330, '分组'),
(9, 9, 1, 1493439330, 1493439330, '配置管理'),
(10, 10, 1, 1493439330, 1493439330, '配置'),
(11, 11, 1, 1493439330, 1493439330, '翻译管理'),
(12, 12, 1, 1493439330, 1493439330, '翻译'),
(13, 13, 1, 1493439330, 1493439330, '超管管理'),
(14, 14, 1, 1493439330, 1493439330, '超级管理员'),
(15, 15, 1, 1493439330, 1493439330, '菜单管理'),
(16, 16, 1, 1493439330, 1493439330, '菜单'),
(17, 17, 1, 1493439330, 1493439330, '语言管理'),
(18, 18, 1, 1493439330, 1493439330, '语言'),
(19, 19, 1, 1493439330, 1493439330, '模块管理'),
(20, 20, 1, 1493439330, 1493439330, '钩子'),
(21, 21, 1, 1493439330, 1493439330, '模块'),
(22, 22, 1, 1493439330, 1493439330, '模板管理'),
(23, 23, 1, 1493439330, 1493439330, '模板'),
(24, 24, 1, 1493439330, 1493439330, '平台管理'),
(25, 25, 1, 1493439330, 1493439330, '平台');

-- --------------------------------------------------------

--
-- Table structure for table `hp_module`
--

CREATE TABLE `hp_module` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `version` char(8) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `name` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_module`
--

INSERT INTO `hp_module` (`id`, `app_id`, `status`, `date_add`, `date_upd`, `version`, `name`) VALUES
(1, 1, 1, 1493439330, 1493439330, '0.0.1', 'One'),
(2, 1, 1, 1493439330, 1493439330, '0.0.1', 'Two'),
(3, 1, 1, 1493439330, 1493439330, '0.0.1', 'Three');

-- --------------------------------------------------------

--
-- Table structure for table `hp_translation`
--

CREATE TABLE `hp_translation` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_lang_from` tinyint(3) UNSIGNED NOT NULL,
  `id_lang_to` tinyint(3) UNSIGNED NOT NULL,
  `key_crc32` int(11) UNSIGNED NOT NULL,
  `key` text NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hp_user`
--

CREATE TABLE `hp_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL,
  `user` char(64) NOT NULL,
  `pass` char(95) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` char(64) NOT NULL DEFAULT '',
  `phone` char(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lastname` char(16) NOT NULL DEFAULT '',
  `firstname` char(16) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_user`
--

INSERT INTO `hp_user` (`id`, `lang_id`, `status`, `date_add`, `date_upd`, `user`, `pass`, `email`, `phone`, `lastname`, `firstname`) VALUES
(1, 1, 1, 1493439330, 1493439330, 'test@hotmail.com', '$argon2i$v=19$m=1024,t=2,p=2$c2NtWmdCb255NGZZUFBOLw$Hoi3pZx1vlPKT6nwtcu9/zyAppezbxKAOW2u1EmtxqA', '', '', 'bobstephen', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hp_acl_group`
--
ALTER TABLE `hp_acl_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_000026` (`app_id`);

--
-- Indexes for table `hp_acl_group_lang`
--
ALTER TABLE `hp_acl_group_lang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_id` (`group_id`,`lang_id`) USING BTREE,
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `hp_acl_group_resource`
--
ALTER TABLE `hp_acl_group_resource`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_id` (`group_id`,`resource_id`),
  ADD KEY `resource_id` (`resource_id`);

--
-- Indexes for table `hp_acl_resource`
--
ALTER TABLE `hp_acl_resource`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `AMCA` (`app`,`module`,`controller`,`action`) USING BTREE,
  ADD KEY `FK_000027` (`app_id`);

--
-- Indexes for table `hp_acl_resource_lang`
--
ALTER TABLE `hp_acl_resource_lang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resource_id` (`resource_id`,`lang_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `hp_acl_role`
--
ALTER TABLE `hp_acl_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_000028` (`app_id`);

--
-- Indexes for table `hp_acl_role_lang`
--
ALTER TABLE `hp_acl_role_lang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_id` (`role_id`,`lang_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `hp_acl_role_resource`
--
ALTER TABLE `hp_acl_role_resource`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_id` (`role_id`,`resource_id`),
  ADD KEY `resource_id` (`resource_id`);

--
-- Indexes for table `hp_acl_user_resource`
--
ALTER TABLE `hp_acl_user_resource`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`resource_id`),
  ADD KEY `resource_id` (`resource_id`);

--
-- Indexes for table `hp_acl_user_role`
--
ALTER TABLE `hp_acl_user_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `hp_app`
--
ALTER TABLE `hp_app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_app_lang`
--
ALTER TABLE `hp_app_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_000031` (`app_id`),
  ADD KEY `FK_000035` (`lang_id`);

--
-- Indexes for table `hp_config`
--
ALTER TABLE `hp_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`name`),
  ADD KEY `FK_000029` (`app_id`);

--
-- Indexes for table `hp_hook`
--
ALTER TABLE `hp_hook`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`name`),
  ADD KEY `FK_000030` (`app_id`);

--
-- Indexes for table `hp_hook_lang`
--
ALTER TABLE `hp_hook_lang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hook_id` (`hook_id`,`lang_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `hp_hook_module`
--
ALTER TABLE `hp_hook_module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FK_000017` (`hook_id`,`module_id`) USING BTREE,
  ADD KEY `FK_000018` (`module_id`);

--
-- Indexes for table `hp_lang`
--
ALTER TABLE `hp_lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_manager`
--
ALTER TABLE `hp_manager`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`) USING BTREE;

--
-- Indexes for table `hp_menu`
--
ALTER TABLE `hp_menu`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `parent` (`parent`),
  ADD KEY `FK_000032` (`app_id`);

--
-- Indexes for table `hp_menu_lang`
--
ALTER TABLE `hp_menu_lang`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_000019` (`menu_id`,`lang_id`) USING BTREE,
  ADD KEY `FK_000020` (`lang_id`) USING BTREE;

--
-- Indexes for table `hp_module`
--
ALTER TABLE `hp_module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`name`),
  ADD KEY `FK_000033` (`app_id`);

--
-- Indexes for table `hp_translation`
--
ALTER TABLE `hp_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_lang_from_id_lang_to_key_crc32` (`id_lang_from`,`id_lang_to`,`key_crc32`);

--
-- Indexes for table `hp_user`
--
ALTER TABLE `hp_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hp_acl_group`
--
ALTER TABLE `hp_acl_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hp_acl_group_lang`
--
ALTER TABLE `hp_acl_group_lang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hp_acl_group_resource`
--
ALTER TABLE `hp_acl_group_resource`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hp_acl_resource`
--
ALTER TABLE `hp_acl_resource`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hp_acl_resource_lang`
--
ALTER TABLE `hp_acl_resource_lang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hp_acl_role`
--
ALTER TABLE `hp_acl_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hp_acl_role_lang`
--
ALTER TABLE `hp_acl_role_lang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hp_acl_role_resource`
--
ALTER TABLE `hp_acl_role_resource`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hp_acl_user_resource`
--
ALTER TABLE `hp_acl_user_resource`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hp_acl_user_role`
--
ALTER TABLE `hp_acl_user_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hp_app`
--
ALTER TABLE `hp_app`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hp_app_lang`
--
ALTER TABLE `hp_app_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hp_config`
--
ALTER TABLE `hp_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hp_hook`
--
ALTER TABLE `hp_hook`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hp_hook_lang`
--
ALTER TABLE `hp_hook_lang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hp_hook_module`
--
ALTER TABLE `hp_hook_module`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hp_lang`
--
ALTER TABLE `hp_lang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hp_manager`
--
ALTER TABLE `hp_manager`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hp_menu`
--
ALTER TABLE `hp_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hp_menu_lang`
--
ALTER TABLE `hp_menu_lang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hp_module`
--
ALTER TABLE `hp_module`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hp_translation`
--
ALTER TABLE `hp_translation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_user`
--
ALTER TABLE `hp_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hp_acl_group`
--
ALTER TABLE `hp_acl_group`
  ADD CONSTRAINT `FK_000026` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_acl_group_lang`
--
ALTER TABLE `hp_acl_group_lang`
  ADD CONSTRAINT `FK_000009` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000012` FOREIGN KEY (`group_id`) REFERENCES `hp_acl_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_acl_group_resource`
--
ALTER TABLE `hp_acl_group_resource`
  ADD CONSTRAINT `FK_000001` FOREIGN KEY (`group_id`) REFERENCES `hp_acl_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000002` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_acl_resource`
--
ALTER TABLE `hp_acl_resource`
  ADD CONSTRAINT `FK_000027` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_acl_resource_lang`
--
ALTER TABLE `hp_acl_resource_lang`
  ADD CONSTRAINT `FK_000010` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000013` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_acl_role`
--
ALTER TABLE `hp_acl_role`
  ADD CONSTRAINT `FK_000028` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_acl_role_lang`
--
ALTER TABLE `hp_acl_role_lang`
  ADD CONSTRAINT `FK_000011` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000014` FOREIGN KEY (`role_id`) REFERENCES `hp_acl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_acl_role_resource`
--
ALTER TABLE `hp_acl_role_resource`
  ADD CONSTRAINT `FK_000003` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000004` FOREIGN KEY (`role_id`) REFERENCES `hp_acl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_acl_user_resource`
--
ALTER TABLE `hp_acl_user_resource`
  ADD CONSTRAINT `FK_000005` FOREIGN KEY (`user_id`) REFERENCES `hp_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000006` FOREIGN KEY (`resource_id`) REFERENCES `hp_acl_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_acl_user_role`
--
ALTER TABLE `hp_acl_user_role`
  ADD CONSTRAINT `FK_000007` FOREIGN KEY (`role_id`) REFERENCES `hp_acl_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000008` FOREIGN KEY (`user_id`) REFERENCES `hp_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_app_lang`
--
ALTER TABLE `hp_app_lang`
  ADD CONSTRAINT `FK_000031` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000035` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_config`
--
ALTER TABLE `hp_config`
  ADD CONSTRAINT `FK_000029` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_hook`
--
ALTER TABLE `hp_hook`
  ADD CONSTRAINT `FK_000030` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_hook_lang`
--
ALTER TABLE `hp_hook_lang`
  ADD CONSTRAINT `FK_000015` FOREIGN KEY (`hook_id`) REFERENCES `hp_hook` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000016` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_hook_module`
--
ALTER TABLE `hp_hook_module`
  ADD CONSTRAINT `FK_000017` FOREIGN KEY (`hook_id`) REFERENCES `hp_hook` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000018` FOREIGN KEY (`module_id`) REFERENCES `hp_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_manager`
--
ALTER TABLE `hp_manager`
  ADD CONSTRAINT `FK_000034` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_menu`
--
ALTER TABLE `hp_menu`
  ADD CONSTRAINT `FK_000022` FOREIGN KEY (`parent`) REFERENCES `hp_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000032` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_menu_lang`
--
ALTER TABLE `hp_menu_lang`
  ADD CONSTRAINT `FK_000019` FOREIGN KEY (`menu_id`) REFERENCES `hp_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_000020` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_module`
--
ALTER TABLE `hp_module`
  ADD CONSTRAINT `FK_000033` FOREIGN KEY (`app_id`) REFERENCES `hp_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hp_user`
--
ALTER TABLE `hp_user`
  ADD CONSTRAINT `FK_000021` FOREIGN KEY (`lang_id`) REFERENCES `hp_lang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
";
}
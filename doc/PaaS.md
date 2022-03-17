``` sql
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `app` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `icon` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `short_description` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `app` (`id`, `user_id`, `icon`, `title`, `short_description`, `description`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, 1, '人事管理系统', '纯文本 短简介', '简介 图文并茂', 1, 1587979192, 1587979192),
(2, 1, 2, '招聘管理系统', '纯文本 短简介', '简介 图文并茂', 1, 1587979192, 1587979192);

CREATE TABLE `app_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `app_category` (`id`, `app_id`, `category_id`, `date_add`, `date_upd`) VALUES
(1, 1, 1, 1587979192, 1587979192),
(2, 1, 2, 1587979192, 1587979192),
(3, 1, 3, 1587979192, 1587979192),
(4, 1, 4, 1587979192, 1587979192),
(5, 1, 5, 1587979192, 1587979192),
(6, 2, 1, 1587979192, 1587979192);

CREATE TABLE `app_table` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `table_id` int(10) UNSIGNED NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `app_table` (`id`, `app_id`, `table_id`, `date_add`, `date_upd`) VALUES
(1, 1, 1, 1587979192, 1587979192),
(2, 1, 2, 1587979192, 1587979192),
(3, 1, 3, 1587979192, 1587979192);

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `category` (`id`, `title`, `date_add`, `date_upd`) VALUES
(1, '官方推荐', 1587979192, 1587979192),
(2, '项目管理', 1587979192, 1587979192),
(3, '人力资源', 1587979192, 1587979192),
(4, '销售管理', 1587979192, 1587979192),
(5, '业务应用', 1587979192, 1587979192);

CREATE TABLE `company` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `company` (`id`, `name`, `status`, `date_add`, `date_upd`) VALUES
(1, '中石化', 1, 1587979192, 1587979192),
(2, '中移动', 1, 1587979192, 1587979192);

CREATE TABLE `component` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `short_description` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `attribute` json NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `component` (`id`, `icon`, `title`, `short_description`, `attribute`, `date_add`, `date_upd`) VALUES
(1, 1, '图表', '图表支持三种类型: 折线图，柱状图，饼图。', '{\"type\": [{\"pie\": {\"icon\": 1, \"statistic\": {\"count\": {\"decimals\": 0, \"showNumber\": 0, \"usePercent\": 0, \"useThousands\": 0}, \"field\": {\"decimals\": 0, \"showNumber\": 0, \"usePercent\": 0, \"useThousands\": 0}}}, \"line\": {\"icon\": 3, \"statistic\": {\"count\": {\"decimals\": 0, \"showNumber\": 0, \"useThousands\": 0}, \"field\": {\"decimals\": 0, \"showNumber\": 0, \"useThousands\": 0}}}, \"histogram\": {\"icon\": 2, \"statistic\": {\"count\": {\"decimals\": 0, \"showNumber\": 0, \"useThousands\": 0}, \"field\": {\"decimals\": 0, \"showNumber\": 0, \"useThousands\": 0}}}}]}', 1587979192, 1587979192),
(2, 2, '备注', '备注用来描述这个应用或者这个仪表盘，帮助更好的理解', '{}', 1587979192, 1587979192),
(3, 3, '统计数字', '统计数字用来显示某个表下某个聚合值。', '{\"type\": [\"count\", \"field\"]}', 1587979192, 1587979192);

CREATE TABLE `com_1_data_1` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `1` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '姓名',
  `2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '介绍',
  `3` int(10) UNSIGNED NOT NULL COMMENT '年龄',
  `4` int(10) UNSIGNED NOT NULL COMMENT '工资',
  `5` int(10) UNSIGNED NOT NULL COMMENT '性别',
  `6` json NOT NULL COMMENT '爱好',
  `7` int(10) UNSIGNED NOT NULL COMMENT '入职日期',
  `8` tinyint(3) NOT NULL DEFAULT '0' COMMENT '婚否',
  `9` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '网址',
  `10` json NOT NULL COMMENT '附件',
  `11` int(10) UNSIGNED NOT NULL COMMENT '公式',
  `12` bigint(20) UNSIGNED NOT NULL COMMENT '手机',
  `13` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '邮箱',
  `14` json NOT NULL COMMENT '关联',
  `15` int(10) UNSIGNED NOT NULL COMMENT '聚合',
  `16` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '引用',
  `17` int(10) UNSIGNED NOT NULL COMMENT '成员',
  `18` bigint(20) UNSIGNED NOT NULL COMMENT '编号',
  `19` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `20` int(10) UNSIGNED NOT NULL COMMENT '修改时间',
  `21` int(10) UNSIGNED NOT NULL COMMENT '创建人',
  `22` int(10) UNSIGNED NOT NULL COMMENT '修改人',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `com_1_data_1` (`id`, `user_id`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, `21`, `22`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, '迪丽热巴-中石化', '可爱的迪丽热巴 图文并茂的介绍', 23, 500000, 3513803203, '[2404513033, 75852161, 3021047786]', 1587979192, 1, 'https://github.com/letwang/HookPHP', '[{\"url\": \"https://oscimg.oschina.net/oscnet/up-1f140c22e71574209a1f1f2d7d7909c3.jpeg\", \"name\": \"头像\"}]', 8569, 8613912345678, 'dilireba@hotmail.com', '[1, 3, 2]', 3, 'M9', 1, 38653919385674, 1587979192, 1587979192, 1, 1, 1, 1587979192, 1587979192);

CREATE TABLE `com_1_data_1_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT '0',
  `action` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `content` json NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `com_1_data_1_history` (`id`, `user_id`, `type`, `action`, `content`, `date_add`) VALUES
(1, 1, 0, 0, '{\"table\": 1}', 1587979192),
(2, 1, 0, 1, '{\"field\": {\"1\": \"吃饭\", \"8\": \"睡觉\"}}', 1587979192),
(3, 1, 1, 0, '{\"comment\": \"加油！\"}', 1587979192);

CREATE TABLE `com_1_data_2` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `23` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '职工名称',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `com_1_data_2` (`id`, `user_id`, `23`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, 'M9', 1, 1587979192, 1587979192),
(2, 1, 'M8', 1, 1587979192, 1587979192),
(3, 1, 'M7', 1, 1587979192, 1587979192);

CREATE TABLE `com_1_data_2_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT '0',
  `action` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `content` json NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `com_1_data_2_history` (`id`, `user_id`, `type`, `action`, `content`, `date_add`) VALUES
(1, 1, 0, 0, '{\"table\": 2}', 1587979192);

CREATE TABLE `com_1_data_3` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `24` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '岗位名称',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `com_1_data_3` (`id`, `user_id`, `24`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, 'CEO', 1, 1587979192, 1587979192);

CREATE TABLE `com_1_data_3_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT '0',
  `action` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `content` json NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `com_1_data_3_history` (`id`, `user_id`, `type`, `action`, `content`, `date_add`) VALUES
(1, 1, 0, 0, '{\"table\": 3}', 1587979192);

CREATE TABLE `com_2_data_1` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `1` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '姓名',
  `2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '介绍',
  `3` int(10) UNSIGNED NOT NULL COMMENT '年龄',
  `4` int(10) UNSIGNED NOT NULL COMMENT '工资',
  `5` int(10) UNSIGNED NOT NULL COMMENT '性别',
  `6` json NOT NULL COMMENT '爱好',
  `7` int(10) UNSIGNED NOT NULL COMMENT '入职日期',
  `8` tinyint(3) NOT NULL DEFAULT '0' COMMENT '婚否',
  `9` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '网址',
  `10` json NOT NULL COMMENT '附件',
  `11` int(10) UNSIGNED NOT NULL COMMENT '公式',
  `12` bigint(20) UNSIGNED NOT NULL COMMENT '手机',
  `13` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '邮箱',
  `14` json NOT NULL COMMENT '关联',
  `15` int(10) UNSIGNED NOT NULL COMMENT '聚合',
  `16` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '引用',
  `17` int(10) UNSIGNED NOT NULL COMMENT '成员',
  `18` bigint(20) UNSIGNED NOT NULL COMMENT '编号',
  `19` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `20` int(10) UNSIGNED NOT NULL COMMENT '修改时间',
  `21` int(10) UNSIGNED NOT NULL COMMENT '创建人',
  `22` int(10) UNSIGNED NOT NULL COMMENT '修改人',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `com_2_data_1` (`id`, `user_id`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, `21`, `22`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, '迪丽热巴-中移动', '可爱的迪丽热巴 图文并茂的介绍', 23, 500000, 3513803203, '[2404513033, 75852161, 3021047786]', 1587979192, 1, 'https://github.com/letwang/HookPHP', '[{\"url\": \"https://oscimg.oschina.net/oscnet/up-1f140c22e71574209a1f1f2d7d7909c3.jpeg\", \"name\": \"头像\"}]', 8569, 8613912345678, 'dilireba@hotmail.com', '[1, 3, 2]', 3, 'P9', 1, 38653919385674, 1587979192, 1587979192, 1, 1, 1, 1587979192, 1587979192);

CREATE TABLE `com_2_data_1_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT '0',
  `action` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `content` json NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `com_2_data_1_history` (`id`, `user_id`, `type`, `action`, `content`, `date_add`) VALUES
(1, 1, 0, 0, '{\"table\": 1}', 1587979192),
(2, 1, 0, 1, '{\"field\": {\"1\": \"吃饭\", \"8\": \"睡觉\"}}', 1587979192),
(3, 1, 1, 0, '{\"comment\": \"加油！\"}', 1587979192);

CREATE TABLE `com_2_data_2` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `23` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '职工名称',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `com_2_data_2` (`id`, `user_id`, `23`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, 'P9', 1, 1587979192, 1587979192),
(2, 1, 'P8', 1, 1587979192, 1587979192),
(3, 1, 'P7', 1, 1587979192, 1587979192);

CREATE TABLE `com_2_data_2_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT '0',
  `action` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `content` json NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `com_2_data_2_history` (`id`, `user_id`, `type`, `action`, `content`, `date_add`) VALUES
(1, 1, 0, 0, '{\"table\": 2}', 1587979192);

CREATE TABLE `com_2_data_3` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `24` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '岗位名称',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `com_2_data_3` (`id`, `user_id`, `24`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, 'CEO', 1, 1587979192, 1587979192);

CREATE TABLE `com_2_data_3_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT '0',
  `action` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `content` json NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `com_2_data_3_history` (`id`, `user_id`, `type`, `action`, `content`, `date_add`) VALUES
(1, 1, 0, 0, '{\"table\": 3}', 1587979192);

CREATE TABLE `count` (
  `id` int(11) NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `post` int(10) UNSIGNED NOT NULL,
  `delete` int(10) UNSIGNED NOT NULL,
  `put` int(10) UNSIGNED NOT NULL,
  `get` int(11) UNSIGNED NOT NULL,
  `down` int(10) UNSIGNED NOT NULL,
  `share` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `count` (`id`, `app_id`, `post`, `delete`, `put`, `get`, `down`, `share`) VALUES
(1, 1, 332, 443, 532, 2532, 1523, 3431),
(2, 2, 344, 531, 451, 55656, 12562, 123);

CREATE TABLE `field` (
  `id` int(10) UNSIGNED NOT NULL,
  `form_id` tinyint(3) UNSIGNED NOT NULL,
  `table_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `attribute` json NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `field` (`id`, `form_id`, `table_id`, `title`, `attribute`, `status`, `date_add`, `date_upd`) VALUES
(1, 1, 1, '姓名', '{\"required\": 1}', 1, 1587979192, 1587979192),
(2, 2, 1, '介绍', '{\"required\": 1}', 1, 1587979192, 1587979192),
(3, 3, 1, '年龄', '{\"decimals\": 2, \"required\": 1, \"showPercent\": 1, \"useThousands\": 1}', 1, 1587979192, 1587979192),
(4, 4, 1, '工资', '{\"symbol\": \"¥\", \"decimals\": 2, \"required\": 1, \"useThousands\": 1}', 1, 1587979192, 1587979192),
(5, 5, 1, '性别', '{\"option\": [{\"id\": 331642374, \"sort\": 2, \"color\": \"fff1cf\", \"title\": \"男\"}, {\"id\": 3513803203, \"sort\": 1, \"color\": \"d1e1ff\", \"title\": \"女\"}, {\"id\": 1674038003, \"sort\": 0, \"color\": \"d8f5da\", \"title\": \"保密\"}], \"required\": 1, \"showType\": 0, \"showColor\": 1}', 1, 1587979192, 1587979192),
(6, 6, 1, '爱好', '{\"option\": [{\"id\": 2404513033, \"sort\": 2, \"color\": \"e6e0ff\", \"title\": \"钓⻥\"}, {\"id\": 75852161, \"sort\": 1, \"color\": \"ecd5ec\", \"title\": \"吃饭\"}, {\"id\": 3021047786, \"sort\": 0, \"color\": \"c0f7f2\", \"title\": \"睡觉\"}], \"required\": 1, \"showColor\": 1}', 1, 1587979192, 1587979192),
(7, 7, 1, '入职日期', '{\"required\": 1, \"timeFormat\": \"hh:mm:ss\", \"supportTime\": 1}', 1, 1587979192, 1587979192),
(8, 8, 1, '婚否', '{\"required\": 1}', 1, 1587979192, 1587979192),
(9, 9, 1, '网址', '{\"required\": 1}', 1, 1587979192, 1587979192),
(10, 10, 1, '附件', '{\"required\": 1}', 1, 1587979192, 1587979192),
(11, 11, 1, '公式', '{\"format\": {\"decimals\": 0, \"showPercent\": 0, \"useThousands\": 1}, \"formula\": \"DATETIME_DIFF(`7`,`20`)\"}', 1, 1587979192, 1587979192),
(12, 12, 1, '手机', '{\"required\": 1}', 1, 1587979192, 1587979192),
(13, 13, 1, '邮箱', '{\"required\": 1}', 1, 1587979192, 1587979192),
(14, 14, 1, '关联', '{\"required\": 1, \"relationType\": 0, \"relationTable\": 2}', 1, 1587979192, 1587979192),
(15, 15, 1, '聚合', '{\"field\": {\"decimals\": 0, \"algorithm\": \"sum\", \"baseField\": 14, \"showPercent\": 0, \"useThousands\": 1}}', 1, 1587979192, 1587979192),
(16, 16, 1, '引用', '{\"baseField\": 14, \"referenceField\": 23}', 1, 1587979192, 1587979192),
(17, 17, 1, '成员', '{\"required\": 1}', 1, 1587979192, 1587979192),
(18, 18, 1, '编号', '{}', 1, 1587979192, 1587979192),
(19, 19, 1, '创建时间', '{\"timeFormat\": \"hh:mm:ss\", \"supportTime\": 1}', 1, 1587979192, 1587979192),
(20, 20, 1, '修改时间', '{\"timeFormat\": \"hh:mm:ss\", \"supportTime\": 1}', 1, 1587979192, 1587979192),
(21, 21, 1, '创建人', '{}', 1, 1587979192, 1587979192),
(22, 22, 1, '修改人', '{}', 1, 1587979192, 1587979192),
(23, 1, 2, '职工名称', '{\"required\": 1}', 1, 1587979192, 1587979192),
(24, 1, 3, '岗位名称', '{\"required\": 1}', 1, 1587979192, 1587979192);

CREATE TABLE `form` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `filter` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `icon` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `placeholder` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `attribute` json NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `form` (`id`, `type`, `filter`, `icon`, `title`, `placeholder`, `attribute`, `date_add`, `date_upd`) VALUES
(1, 0, 1, 1, '单行文本', '名称', '{\"filter\": [{\"contains\": \"包含\"}, {\"not_contains\": \"不包含\"}, {\"eq\": \"等于\"}, {\"neq\": \"不等于\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}], \"required\": 0}', 1587979192, 1587979192),
(2, 0, 0, 2, '多行文本', '描述', '{\"required\": 0}', 1587979192, 1587979192),
(3, 0, 1, 3, '数字', '数字', '{\"filter\": [{\"eq\": \"等于\"}, {\"neq\": \"不等于\"}, {\"lt\": \"小于\"}, {\"gt\": \"大于\"}, {\"lte\": \"小于等于\"}, {\"gte\": \"大于等于\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}], \"decimals\": 0, \"required\": 0, \"showPercent\": 0, \"useThousands\": 0}', 1587979192, 1587979192),
(4, 0, 1, 4, '货币', '货币', '{\"filter\": [{\"eq\": \"等于\"}, {\"neq\": \"不等于\"}, {\"lt\": \"小于\"}, {\"gt\": \"大于\"}, {\"lte\": \"小于等于\"}, {\"gte\": \"大于等于\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空 \"}], \"symbol\": [\"¥\", \"$\"], \"decimals\": 0, \"required\": 0, \"useThousands\": 0}', 1587979192, 1587979192),
(5, 0, 1, 5, '单项选择', '单选', '{\"filter\": [{\"in\": \"是\"}, {\"nin\": \"不是\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}], \"required\": 0, \"showType\": [0, 1], \"showColor\": 1}', 1587979192, 1587979192),
(6, 0, 1, 6, '多项选择', '多选', '{\"filter\": [{\"eq\": \"等于\"}, {\"neq\": \"不等于\"}, {\"contains\": \"包含\"}, {\"in\": \"包含任一\"}, {\"not_contains\": \"不包含\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}], \"required\": 0, \"showColor\": 1}', 1587979192, 1587979192),
(7, 0, 1, 7, '日期', '日期', '{\"filter\": [{\"in\": \"是\"}, {\"nin\": \"不是\"}, {\"earlier\": \"早于\"}, {\"later\": \"晚于\"}, {\"between\": \"在范围内\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}], \"required\": 0, \"timeFormat\": [\"hh:mm:ss\", \"hh:mm\"], \"supportTime\": 0}', 1587979192, 1587979192),
(8, 0, 1, 8, '勾选', '勾选', '{\"filter\": [{\"checked\": \"选中\"}, {\"not_checked\": \"未选中\"}], \"required\": 0}', 1587979192, 1587979192),
(9, 0, 0, 9, '网址', '网址', '{\"required\": 0}', 1587979192, 1587979192),
(10, 0, 0, 10, '附件', '附件', '{\"required\": 0}', 1587979192, 1587979192),
(11, 0, 1, 11, '公式', '公式', '{\"filter\": [{\"in\": \"是\"}, {\"nin\": \"不是\"}, {\"earlier\": \"早于\"}, {\"later\": \"晚于\"}, {\"between\": \"在范围内\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}], \"formula\": [\"CONCATENATE\", \"DATETIME_DIFF\", \"NOW\", \"IF\"]}', 1587979192, 1587979192),
(12, 0, 1, 12, '手机', '手机', '{\"filter\": [{\"contains\": \"包含\"}, {\"not_contains\": \"不包含\"}, {\"eq\": \"等于\"}, {\"neq\": \"不等于\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}], \"required\": 0}', 1587979192, 1587979192),
(13, 0, 1, 13, '邮箱', '邮箱', '{\"filter\": [{\"contains\": \"包含\"}, {\"not_contains\": \"不包含\"}, {\"eq\": \"等于\"}, {\"neq\": \"不等于\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}], \"required\": 0}', 1587979192, 1587979192),
(14, 1, 0, 14, '关联表', '关联', '{\"required\": 0, \"relationType\": [0, 1]}', 1587979192, 1587979192),
(15, 1, 1, 15, '数据聚合', '聚合', '{\"count\": 1, \"field\": {\"algorithm\": [\"sum\", \"avg\", \"max\", \"min\"]}, \"filter\": [{\"eq\": \"等于\"}, {\"neq\": \"不等于\"}, {\"lt\": \"小于\"}, {\"gt\": \"大于\"}, {\"lte\": \"小于等于\"}, {\"gte\": \"大于等于\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空 \"}]}', 1587979192, 1587979192),
(16, 1, 1, 16, '引用', '引用', '{\"filter\": [{\"contains\": \"包含\"}, {\"not_contains\": \"不包含\"}, {\"eq\": \"等于\"}, {\"neq\": \"不等于\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}]}', 1587979192, 1587979192),
(17, 2, 1, 17, '成员', '成员', '{\"filter\": [{\"in\": \"是\"}, {\"nin\": \"不是\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}], \"required\": 0}', 1587979192, 1587979192),
(18, 2, 0, 18, '流水号', '编号', '{}', 1587979192, 1587979192),
(19, 2, 1, 19, '创建时间', '创建时间', '{\"filter\": [{\"in\": \"是\"}, {\"nin\": \"不是\"}, {\"earlier\": \"早于\"}, {\"later\": \"晚于\"}, {\"between\": \"在范围内\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}], \"timeFormat\": [\"hh:mm:ss\", \"hh:mm\"], \"supportTime\": 1}', 1587979192, 1587979192),
(20, 2, 1, 20, '修改时间', '修改时间', '{\"filter\": [{\"in\": \"是\"}, {\"nin\": \"不是\"}, {\"earlier\": \"早于\"}, {\"later\": \"晚于\"}, {\"between\": \"在范围内\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}], \"timeFormat\": [\"hh:mm:ss\", \"hh:mm\"], \"supportTime\": 1}', 1587979192, 1587979192),
(21, 2, 1, 21, '创建人', '创建人', '{\"filter\": [{\"in\": \"是\"}, {\"nin\": \"不是\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}]}', 1587979192, 1587979192),
(22, 2, 1, 22, '修改人', '修改人', '{\"filter\": [{\"in\": \"是\"}, {\"nin\": \"不是\"}, {\"empty\": \"为空\"}, {\"not_empty\": \"不为空\"}]}', 1587979192, 1587979192);

CREATE TABLE `table` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `table` (`id`, `icon`, `title`, `date_add`, `date_upd`) VALUES
(1, 1, '员工档案', 1587979192, 1587979192),
(2, 2, '职工级别', 1587979192, 1587979192),
(3, 3, '岗位设定', 1587979192, 1587979192);

CREATE TABLE `view_system` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `short_description` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `view_system` (`id`, `title`, `short_description`, `date_add`, `date_upd`) VALUES
(1, '表格视图', '', 1587979192, 1587979192),
(2, '看板视图', '您即将创建一个看板视图。请选择一个用于分组的单选字段，这个业务表的数据会根据这个字段生成卡片列表。', 1587979192, 1587979192),
(3, '日历视图', '您即将创建一个日历视图。请选择一个日期字段，这个业务表的数据会根据这个字段生成日历视图。', 1587979192, 1587979192),
(4, '表单视图', '表单视图允许您将定义好的业务表通过表单呈现，允许他人通过扫码直接提交数据。数据实时收集，您可以将这些数据与其他业务表做进一步处理。 表单视图是付费功能。请升级套餐以继续使用。', 1587979192, 1587979192);

CREATE TABLE `view_table` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `table_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `attribute` json NOT NULL,
  `date_add` int(10) UNSIGNED NOT NULL,
  `date_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `view_table` (`id`, `type`, `sort`, `table_id`, `user_id`, `title`, `attribute`, `date_add`, `date_upd`) VALUES
(1, 0, 0, 1, 1, '默认视图', '{\"sort\": 3, \"order\": \"asc\", \"visible\": {\"1\": 0, \"5\": 0, \"10\": 0}}', 1587979192, 1587979192),
(2, 1, 1, 1, 1, '表格视图', '{}', 1587979192, 1587979192),
(3, 1, 2, 1, 1, '看板视图', '{}', 1587979192, 1587979192),
(4, 2, 3, 1, 1, '日历视图', '{}', 1587979192, 1587979192);


ALTER TABLE `app`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `app_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_category` (`app_id`,`category_id`) USING BTREE;

ALTER TABLE `app_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_table` (`app_id`,`table_id`) USING BTREE;

ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `component`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `com_1_data_1`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `com_1_data_1_history`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `com_1_data_2`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `com_1_data_2_history`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `com_1_data_3`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `com_1_data_3_history`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `com_2_data_1`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `com_2_data_1_history`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `com_2_data_2`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `com_2_data_2_history`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `com_2_data_3`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `com_2_data_3_history`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `count`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_id` (`app_id`);

ALTER TABLE `field`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `view_system`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `view_table`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `app`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `app_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `app_table`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `component`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `com_1_data_1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `com_1_data_1_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `com_1_data_2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `com_1_data_2_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `com_1_data_3`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `com_1_data_3_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `com_2_data_1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `com_2_data_1_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `com_2_data_2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `com_2_data_2_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `com_2_data_3`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `com_2_data_3_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `field`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `form`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

ALTER TABLE `table`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `view_system`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `view_table`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;
```

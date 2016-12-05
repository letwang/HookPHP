<?php
namespace Install\Init;

class Mysql
{

    const base = "CREATE TABLE `hp_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` varchar(64) NOT NULL,
  `pass` char(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hp_user` (`id`, `user`, `pass`, `active`) VALUES
(1, 'admin@hookphp.com', '6abedafaed3f1d50eb07a087d5a93d15de821702dbb4c4fcc136cb69ae05f9a6', 1);

ALTER TABLE `hp_user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `hp_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";

    const translation = 'CREATE TABLE IF NOT EXISTS `translation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_lang_from` tinyint(3) unsigned NOT NULL,
  `id_lang_to` tinyint(3) unsigned NOT NULL,
  `key_crc32` int(11) unsigned NOT NULL,
  `key` text NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_lang_from_id_lang_to_key_crc32` (`id_lang_from`,`id_lang_to`,`key_crc32`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2016 at 09:42 AM
-- Server version: 5.6.31-0ubuntu0.14.04.2
-- PHP Version: 5.6.21-1+donate.sury.org~precise+4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE `acl` (
  `id_acl` int(10) UNSIGNED NOT NULL,
  `id_group` int(10) UNSIGNED NOT NULL,
  `id_resource` int(10) UNSIGNED NOT NULL,
  `view` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `add` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `edit` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `delete` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_employee` int(10) UNSIGNED NOT NULL,
  `id_group` int(10) UNSIGNED NOT NULL,
  `id_lang` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `pass` varchar(64) NOT NULL,
  `time_add` int(10) UNSIGNED NOT NULL,
  `time_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id_group` int(10) UNSIGNED NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `time_add` int(10) UNSIGNED NOT NULL,
  `time_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group_lang`
--

CREATE TABLE `group_lang` (
  `id_group` int(10) UNSIGNED NOT NULL,
  `id_lang` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `id_resource` int(10) UNSIGNED NOT NULL,
  `key` varchar(64) NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `time_add` int(10) UNSIGNED NOT NULL,
  `time_upd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resource_lang`
--

CREATE TABLE `resource_lang` (
  `id_resource` int(10) UNSIGNED NOT NULL,
  `id_lang` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl`
--
ALTER TABLE `acl`
  ADD PRIMARY KEY (`id_acl`),
  ADD UNIQUE KEY `id_group_resource` (`id_group`,`id_resource`) USING BTREE;

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `active_pass` (`active`,`pass`) USING BTREE,
  ADD KEY `id_group` (`id_group`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id_group`),
  ADD KEY `active` (`active`) USING BTREE;

--
-- Indexes for table `group_lang`
--
ALTER TABLE `group_lang`
  ADD UNIQUE KEY `id_group_lang` (`id_group`,`id_lang`) USING BTREE;

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`id_resource`),
  ADD UNIQUE KEY `key_active` (`key`,`active`) USING BTREE;

--
-- Indexes for table `resource_lang`
--
ALTER TABLE `resource_lang`
  ADD UNIQUE KEY `id_resource_lang` (`id_resource`,`id_lang`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acl`
--
ALTER TABLE `acl`
  MODIFY `id_acl` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id_group` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `id_resource` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


';
}

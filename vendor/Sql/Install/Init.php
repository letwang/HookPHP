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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;';
}
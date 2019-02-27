<?php
namespace Hook\Sql;

class Menu
{
    const GET_ALL = 'SELECT a.`id`, `parent`, `status`, `position`, `date_add`, `date_upd`, `url`, `icon`,`name` FROM `hp_menu` a LEFT JOIN `hp_menu_lang` b ON a.`id`=b.`menu_id` WHERE a.`app_id`=1 AND a.`status`=1 AND b.`lang_id`=? ORDER BY a.`position`';
    const GET_SHOW_ALL = 'SELECT a.`id`,a.`parent`,a.`url`,a.`icon`,b.`name` FROM `hp_menu` a LEFT JOIN `hp_menu_lang` b ON a.`id`=b.`menu_id` WHERE a.`app_id`=1 AND a.`status`=1 AND b.`lang_id`=1 ORDER BY a.`position`';
}
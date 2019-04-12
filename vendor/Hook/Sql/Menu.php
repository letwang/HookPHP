<?php
namespace Hook\Sql;

class Menu
{
    const GET_ALL = 'SELECT a.`id`, `parent`, `status`, `position`, `date_add`, `date_upd`, `url`, `icon`,`name` FROM `hp_'.APP_NAME.'_menu` a LEFT JOIN `hp_'.APP_NAME.'_menu_lang` b ON a.`id`=b.`menu_id` WHERE a.`status`=1 AND b.`lang_id`=? ORDER BY a.`position`';
    const GET_SHOW_ALL = 'SELECT a.`id`,a.`parent`,a.`url`,a.`icon`,b.`name` FROM `hp_'.APP_NAME.'_menu` a LEFT JOIN `hp_'.APP_NAME.'_menu_lang` b ON a.`id`=b.`menu_id` WHERE a.`status`=1 AND b.`lang_id`=? ORDER BY a.`position`';
    const GET_SHOW_SELECT = 'SELECT a.`id`,b.`name` FROM `hp_'.APP_NAME.'_menu` a LEFT JOIN `hp_'.APP_NAME.'_menu_lang` b ON a.`id`=b.`menu_id` WHERE a.`status`=1 AND b.`lang_id`=? ORDER BY a.`position`';
}
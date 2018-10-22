<?php
namespace Hook\Sql;

class Menu
{
    const SQL_GET_MENUS = 'SELECT a.`id`,a.`parent`,a.`url`,a.`icon`,b.`name` FROM `hp_menu` a LEFT JOIN `hp_menu_lang` b ON a.`id`=b.`menu_id` WHERE a.`app_id`=1 AND a.`status`=1 AND b.`lang_id`=1 ORDER BY a.`position`';
}
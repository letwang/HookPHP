<?php
namespace Hook\Sql\Acl;

class Group
{
    const GET_ALL = 'SELECT a.`id`,a.`status`,a.`date_add`,a.`date_upd`,b.`name` FROM `hp_rbac_group` a LEFT JOIN `hp_rbac_group_lang` b ON a.`id`=b.`group_id` WHERE a.`app_id`=? AND b.`lang_id`=?';
    const GET_SHOW_SELECT = 'SELECT a.`id`,b.`name` FROM `hp_rbac_group` a LEFT JOIN `hp_rbac_group_lang` b ON a.`id`=b.`group_id` WHERE a.`app_id`=? AND a.`status`=1 AND b.`lang_id`=?';
}
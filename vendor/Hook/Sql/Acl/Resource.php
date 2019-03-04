<?php
namespace Hook\Sql\Acl;

class Resource
{
    const GET_ALL = 'SELECT a.`id`,a.`status`,a.`date_add`,a.`date_upd`,a.`module`,a.`controller`,a.`action`,b.`name` FROM `hp_acl_resource` a LEFT JOIN `hp_acl_resource_lang` b ON a.`id`=b.`resource_id` WHERE a.`app_id`=? AND b.`lang_id`=?';
    const GET_SHOW_SELECT = 'SELECT a.`id`,b.`name` FROM `hp_acl_resource` a LEFT JOIN `hp_acl_resource_lang` b ON a.`id`=b.`resource_id` WHERE a.`app_id`=? AND a.`status`=1 AND b.`lang_id`=?';
}
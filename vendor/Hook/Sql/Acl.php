<?php
namespace Hook\Sql;

class Acl
{
    const GET_GROUP = 'SELECT a.`id`,a.`status`,a.`date_add`,a.`date_upd`,b.`name` FROM `hp_acl_group` a LEFT JOIN `hp_acl_group_lang` b ON a.`id`=b.`group_id` WHERE a.`app_id`=? AND b.`lang_id`=?';
    const GET_RESOURCE = 'SELECT a.`id`,a.`status`,a.`date_add`,a.`date_upd`,a.`app`,a.`module`,a.`controller`,a.`action`,b.`name` FROM `hp_acl_resource` a LEFT JOIN `hp_acl_resource_lang` b ON a.`id`=b.`resource_id` WHERE a.`app_id`=? AND b.`lang_id`=?';
    const GET_ROLE = 'SELECT a.`id`,a.`status`,a.`date_add`,a.`date_upd`,b.`name` FROM `hp_acl_role` a LEFT JOIN `hp_acl_role_lang` b ON a.`id`=b.`role_id` WHERE a.`app_id`=? AND b.`lang_id`=?';
}
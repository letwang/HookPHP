<?php
namespace Hook\Sql\Hook;

class Module
{

    const GET_ALL = 'SELECT a.`key`,c.`key` as module FROM `hp_'.APP_NAME.'_hook_hook` a LEFT JOIN`hp_'.APP_NAME.'_hook_hook_module` b ON a.`id`=b.`hook_id` LEFT JOIN `hp_'.APP_NAME.'_hook_module` c ON b.`module_id`=c.`id` WHERE c.`status`=1 ORDER BY b.`position` DESC';
}
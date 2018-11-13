<?php
namespace Hook\Sql;

class Module
{

    const GET_ALL = 'SELECT a.`name`,c.`name` as module FROM `hp_hook` a LEFT JOIN`hp_hook_module` b ON a.`id`=b.`hook_id` LEFT JOIN `hp_module` c ON b.`module_id`=c.`id` WHERE c.`status`=1 ORDER BY b.`position` DESC';
}
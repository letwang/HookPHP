<?php
namespace Hook\Sql\Hook;

class Module
{

    const GET_ALL = 'SELECT a.`key`,c.`key` as module FROM `hp_hook` a LEFT JOIN`hp_hook_module` b ON a.`id`=b.`hook_id` LEFT JOIN `hp_module` c ON b.`module_id`=c.`id` WHERE c.`status`=1 ORDER BY b.`position` DESC';
    const GET_SHOW_SELECT = 'SELECT `id`,`key` FROM `hp_module` WHERE `app_id`=? AND `status`=1';
}
<?php
namespace Hook\Sql;

class Hook
{
    const GET_ALL = 'SELECT a.`position`,a.`date_add`,a.`date_upd`,a.`name`,b.`name`,b.`title`,b.`description` FROM `hp_hook` a LEFT JOIN `hp_hook_lang` b ON a.`id`=b.`hook_id` WHERE b.`lang_id`=?';
}
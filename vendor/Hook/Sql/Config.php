<?php
namespace Hook\Sql;

class Config
{
    const GET_All = 'SELECT `id`, `status`, `date_add`, `date_upd`, `key`, `value` FROM `hp_config` WHERE `app_id`=?';
    const GET_DEFINED = 'SELECT `key`,`value` FROM `hp_config` WHERE `app_id`=? AND `status`=1';
}
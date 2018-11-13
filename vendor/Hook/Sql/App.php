<?php
namespace Hook\Sql;

class App
{
    const GET_All = 'SELECT a.`id`,a.`status`,a.`date_add`,a.`date_upd`,a.`name`,b.`description` FROM `hp_app` a LEFT JOIN `hp_app_lang` b ON a.`id`=b.`app_id` WHERE b.`lang_id`=?';
}
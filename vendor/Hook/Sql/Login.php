<?php
namespace Hook\Sql;

class Login
{

    const GET_MANAGER = 'SELECT `id`, `lang_id`, `date_add`, `date_upd`, `user`, `pass` FROM `hp_manager` WHERE `user` = ? OR `email` = ? OR `phone` = ? AND `status` = 1 LIMIT 1';
}
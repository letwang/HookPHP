<?php
namespace Hook\Sql;

class User
{
    const GET_ALL = 'SELECT `id`, `status`, `date_add`, `date_upd`, `user`, `pass`, `email`, `phone`, `lastname`, `firstname` FROM `hp_user` WHERE 1';
    const GET_SHOW_SELECT = 'SELECT `id`,`user` FROM `hp_manager` WHERE 1';
}
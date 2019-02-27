<?php
namespace Hook\Sql;

class Manager
{
    const GET_ALL = 'SELECT `id`, `status`, `date_add`, `date_upd`, `user`, `pass`, `email`, `phone`, `lastname`, `firstname` FROM `hp_manager` WHERE 1';
}
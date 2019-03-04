<?php
namespace Hook\Sql\User;

class User
{
    const GET_ALL = 'SELECT `id`, `status`, `date_add`, `date_upd`, `user`, `pass`, `email`, `phone`, `lastname`, `firstname` FROM `hp_user` WHERE 1';
}
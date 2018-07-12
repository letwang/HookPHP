<?php
namespace Hook\Sql;

class Login
{

    const SQL_LOGIN = 'SELECT * FROM `hp_user` WHERE `user` = ? AND `pass` = ? AND `status` = 1 LIMIT 1';
}
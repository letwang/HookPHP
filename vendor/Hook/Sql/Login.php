<?php
namespace Hook\Sql;

class Login
{
    const GET_MANAGER = 'SELECT * FROM `hp_manager` WHERE `user` = ? OR `email` = ? OR `phone` = ? AND `status` = 1 LIMIT 1';
}
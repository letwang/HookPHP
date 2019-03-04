<?php
namespace Hook\Sql\Acl;

class User
{
    const GET_SHOW_SELECT = 'SELECT `id`,`user` FROM `hp_user` WHERE `status`=1';
}
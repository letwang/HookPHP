<?php
use Hook\Db\Orm;

class LoginModel extends Base\AbstractModel
{
    public static $table = 'hp_manager';

    public static function signIn(string $user)
    {
        return Orm::getInstance(static::$table)->select(['*'])
        ->where(['user' => $user], 'OR')
        ->where(['email' => $user], 'OR')
        ->where(['phone' => $user])
        ->where(['status' => 1])
        ->fetch();
    }
}
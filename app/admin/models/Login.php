<?php
use Hook\Db\OrmConnect;

class LoginModel extends Base\AbstractModel
{
    public static function signIn(string $user)
    {
        return OrmConnect::getInstance($this->table)->select(['*'])
        ->where(['user' => $user, 'email' => $user, 'phone' => $user], 'AND', 'OR')
        ->where(['status' => 1])
        ->fetch();
    }
}
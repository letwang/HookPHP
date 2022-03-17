<?php
declare(strict_types=1);

use Hook\Db\OrmConnect;

class LoginModel extends Base\AbstractModel
{
    public string $table = 'admin_manager';

    public function signIn(string $user)
    {
        return OrmConnect::getInstance($this->table)->select(['*'])
        ->where(['user' => $user, 'email' => $user, 'phone' => $user], 'AND', 'OR')
        ->where(['status' => 1])
        ->fetch();
    }
}
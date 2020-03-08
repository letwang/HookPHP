<?php
use Hook\Db\OrmConnect;

class UserModel extends Base\AbstractModel
{
    public string $table = 'admin_user';
    public array $fields = [
        'status' => ['type' => parent::BOOL, 'validate' => 'isBool'],
        'user' => ['required' => true, 'validate' => 'isGenericName'],
        'pass' => ['required' => true],
        'email' => ['required' => true, 'validate' => 'isEmail'],
        'phone' => ['required' => true, 'validate' => 'isPhone'],
        'lastname' => ['validate' => 'isGenericName'],
        'firstname' => ['validate' => 'isGenericName'],
    ];

    public function get(): array
    {
        return OrmConnect::getInstance($this->table)->select(['id', 'app_id', 'status', 'date_add', 'date_upd', 'user', 'email', 'phone', 'lastname', 'firstname'])->fetchAll();
    }
}

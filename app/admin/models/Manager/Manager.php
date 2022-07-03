<?php
declare(strict_types=1);

namespace Manager;

use Hook\Db\OrmConnect;

class ManagerModel extends \Base\AbstractModel
{
    public string $table = 'admin_manager';
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

    public function getSelect(): array
    {
        return OrmConnect::getInstance($this->table)->select(['id', 'user'])->where(['status' => 1])->fetchAll(\PDO::FETCH_KEY_PAIR);
    }
}
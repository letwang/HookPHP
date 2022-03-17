<?php
declare(strict_types=1);

namespace Hook;
use Hook\Db\OrmConnect;

class ModuleModel extends \Base\AbstractModel
{
    public array $fields = [
        'version' => ['required' => true, 'validate' => 'isGenericName'],
        'key' => ['required' => true, 'validate' => 'isGenericName'],
    ];

    public function getSelect(): array
    {
        return OrmConnect::getInstance($this->table)->select(['id', 'key'])->where(['status' => 1])->fetchAll(\PDO::FETCH_KEY_PAIR);
    }
}
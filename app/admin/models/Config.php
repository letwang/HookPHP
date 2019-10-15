<?php
use Hook\Db\{OrmConnect};

class ConfigModel extends Base\AbstractModel
{
    public $fields = [
        'key' => ['required' => true, 'validate' => 'isGenericName'],
        'value' => ['required' => true],
    ];

    public function getDefined(): array
    {
        return OrmConnect::getInstance($this->table)->select(['key', 'value'])->where(['status' => 1])->fetchAll(PDO::FETCH_KEY_PAIR);
    }
}
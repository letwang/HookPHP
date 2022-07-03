<?php
declare(strict_types=1);

use Hook\Db\{OrmConnect};

class StateModel extends Base\AbstractModel
{
    public string $table = 'admin_state';
    public array $fields = [
        'status' => ['type' => parent::BOOL, 'validate' => 'isBool'],
    ];

    public function get(): array
    {
        return $this->orm->queryAll(apcu_fetch('global')['sql']['STATE']['GET_All']);
    }
}
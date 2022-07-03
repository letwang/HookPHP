<?php
declare(strict_types=1);

use Hook\Db\{OrmConnect};

class ZoneModel extends Base\AbstractModel
{
    public string $table = 'admin_zone';
    public array $fields = [
        'status' => ['type' => parent::BOOL, 'validate' => 'isBool'],
    ];

    public function get(): array
    {
        return $this->orm->queryAll(apcu_fetch('global')['sql']['ZONE']['GET_All']);
    }
}
<?php
declare(strict_types=1);

use Hook\Db\{OrmConnect};

class TimezoneModel extends Base\AbstractModel
{
    public string $table = 'admin_timezone';
    public array $fields = [
        'status' => ['type' => parent::BOOL, 'validate' => 'isBool'],
    ];

    public function get(): array
    {
        return $this->orm->queryAll(apcu_fetch('global')['sql']['TIMEZONE']['GET_All']);
    }
}
<?php
declare(strict_types=1);

use Hook\Db\{OrmConnect};

class CurrencyModel extends Base\AbstractModel
{
    public string $table = 'admin_currency';
    public array $fields = [
        'status' => ['type' => parent::BOOL, 'validate' => 'isBool'],
    ];

    public function get(): array
    {
        return $this->orm->queryAll(apcu_fetch('global')['sql']['CURRENCY']['GET_All'], [APP_LANG_ID]);
    }
}
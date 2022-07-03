<?php
declare(strict_types=1);

use Hook\Db\{OrmConnect};

class CountryModel extends Base\AbstractModel
{
    public string $table = 'admin_country';
    public array $fields = [
        'status' => ['type' => parent::BOOL, 'validate' => 'isBool'],
    ];

    public function get(): array
    {
        return $this->orm->queryAll(apcu_fetch('global')['sql']['COUNTRY']['GET_All'], [APP_LANG_ID]);
    }
}
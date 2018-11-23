<?php
use Hook\Db\Table;

class ConfigModel extends AbstractModel
{
    public $table = 'hp_config';
    public $fields = [
        'date_add' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'date_upd' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'key' => array('type' => 6, 'require' => true, 'validate' => 'isGenericName'),
        'value' => array('type' => 5, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(int $id = 0, int $langId = 0): array
    {
        return parent::read($this->table, $id, $langId);
    }
}
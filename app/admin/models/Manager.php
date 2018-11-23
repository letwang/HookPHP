<?php
use Hook\Db\Table;

class ManagerModel extends AbstractModel
{
    public $table = 'hp_manager';
    public $fields = [
        'status' => array('type' => 2, 'require' => true, 'validate' => 'isGenericName'),
        'date_add' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'date_upd' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'user' => array('type' => 6, 'require' => true, 'validate' => 'isGenericName'),
        'pass' => array('type' => 6, 'require' => true, 'validate' => 'isGenericName'),
        'email' => array('type' => 6, 'require' => true, 'validate' => 'isGenericName'),
        'phone' => array('type' => 6, 'require' => true, 'validate' => 'isGenericName'),
        'lastname' => array('type' => 6, 'require' => true, 'validate' => 'isGenericName'),
        'firstname' => array('type' => 6, 'require' => true, 'validate' => 'isGenericName'),
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
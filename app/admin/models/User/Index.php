<?php
namespace User;
use Hook\Db\Table;

class IndexModel extends \AbstractModel
{
    public $table = 'hp_user';
    public $fields = [
        'status' => array('type' => 2, 'require' => true, 'validate' => 'isInt'),
        'date_add' => array('type' => 1, 'require' => true, 'validate' => 'isInt'),
        'date_upd' => array('type' => 1, 'require' => true, 'validate' => 'isInt'),
        'user' => array('type' => 6, 'require' => true, 'validate' => 'isGenericName'),
        'pass' => array('type' => 6, 'require' => true),
        'email' => array('type' => 6, 'require' => true, 'validate' => 'isEmail'),
        'phone' => array('type' => 6, 'require' => true, 'validate' => 'isPhone'),
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
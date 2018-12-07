<?php

class ManagerModel extends AbstractModel
{
    public static $table = 'hp_manager';
    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'user' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'pass' => array('type' => parent::NOTHING, 'require' => true),
        'email' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isEmail'),
        'phone' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isPhone'),
        'lastname' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'firstname' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(int $id = 0, int $langId = 0): array
    {
        return parent::read(self::$table, $id, $langId);
    }
}
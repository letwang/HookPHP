<?php
use Hook\Db\PdoConnect;
use Hook\Sql\App;

class AppModel extends AbstractModel
{
    public $table = 'hp_app';
    public $foreign = 'app_id';

    public $fields = [
        'status' => array('type' => 2, 'require' => true, 'validate' => 'isInt'),
        'date_add' => array('type' => 1, 'require' => true, 'validate' => 'isInt'),
        'date_upd' => array('type' => 1, 'require' => true, 'validate' => 'isInt'),
        'key' => array('type' => 6, 'require' => true, 'validate' => 'isGenericName'),
        'description' => array('type' => 5, 'require' => true),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(int $id = 0, int $langId = 0): array
    {
        return PdoConnect::getInstance()->fetchAll(App::GET_All, [$_SESSION[APP_NAME]['lang_id']]);
    }
}
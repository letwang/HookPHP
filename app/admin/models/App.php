<?php
use Hook\Db\PdoConnect;
use Hook\Sql\App;

class AppModel extends AbstractModel
{
    public static $table = 'hp_app';
    public static $foreign = 'app_id';

    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'description' => array('require' => true),
    ];

    public function __construct(int $id = null, int $langId = null)
    {
        parent::__construct($id, $langId);
    }

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(App::GET_All, [$_SESSION[APP_NAME]['lang_id']]);
    }
}
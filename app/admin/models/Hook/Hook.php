<?php
namespace Hook;

use \Yaconf;

class HookModel extends \Base\AbstractModel
{
    public $fields = [
        'position' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
        'title' => array('require' => true, 'validate' => 'isGenericName'),
        'description' => array('require' => true),
    ];

    public function get(): array
    {
        return $this->pdo->fetchAll(Yaconf::get('sql.HOOK.HOOK.GET_ALL'), [APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        return $this->pdo->fetchAll(Yaconf::get('sql.HOOK.HOOK.GET_SELECT'), [APP_LANG_ID], \PDO::FETCH_KEY_PAIR);
    }
}
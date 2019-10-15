<?php
namespace Hook;

use \Yaconf;

class HookModel extends \Base\AbstractModel
{
    public $fields = [
        'position' => ['type' => parent::INT, 'required' => true, 'validate' => 'isInt'],
        'key' => ['required' => true, 'validate' => 'isGenericName'],
        'name' => ['required' => true, 'validate' => 'isGenericName'],
        'title' => ['required' => true, 'validate' => 'isGenericName'],
        'description' => ['type' => parent::HTML],
    ];

    public function get(): array
    {
        return $this->pdo->fetchAll(Yaconf::get('dicPdo.HOOK.HOOK.GET_ALL'), [APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        return $this->pdo->fetchAll(Yaconf::get('dicPdo.HOOK.HOOK.GET_SELECT'), [APP_LANG_ID], \PDO::FETCH_KEY_PAIR);
    }
}
<?php
use Hook\Data\ArrayUtils;

class MenuModel extends Base\AbstractModel
{
    public $fields = [
        'parent' => array('type' => parent::INT, 'require' => false, 'validate' => 'isInt'),
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'position' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'url' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'icon' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
    ];

    public function get(): array
    {
        return $this->pdo->fetchAll(Yaconf::get('dicPdo.MENU.GET_ALL'), [APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        return $this->pdo->fetchAll(Yaconf::get('dicPdo.MENU.GET_SELECT'), [APP_LANG_ID], PDO::FETCH_KEY_PAIR);
    }

    public function getMenu(): array
    {
        $utils = new ArrayUtils();
        $utils->idKey = 'id';
        $utils->parentIdKey = 'parent';
        $data = $utils->classify($this->pdo->fetchAll(Yaconf::get('dicPdo.MENU.GET_MENU'), [APP_LANG_ID]));
        return $data;
    }
}
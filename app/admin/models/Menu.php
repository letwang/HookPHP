<?php
use Hook\Data\ArrayUtils;

class MenuModel extends Base\AbstractModel
{
    public array $fields = [
        'parent' => ['type' => parent::INT, 'validate' => 'isInt'],
        'status' => ['type' => parent::BOOL, 'validate' => 'isBool'],
        'position' => ['type' => parent::INT, 'validate' => 'isInt'],
        'url' => ['validate' => 'isGenericName'],
        'icon' => ['validate' => 'isGenericName'],
        'name' => ['validate' => 'isGenericName'],
    ];

    public function get(): array
    {
        return $this->pdo->fetchAll(Yaconf::get('dicPdo.MENU.GET_ALL'), [APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        $result = ['' => '顶级分类'];
        $data = $this->getMenu();
        foreach ($data as &$value) {
            $result[$value['id']] = $value['name'];
            foreach ($value['childs'] as &$v) {
                $result[$v['id']] = '|----'.$v['name'];
            }
        }
        return $result;
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
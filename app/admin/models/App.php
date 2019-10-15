<?php
use Hook\Db\{OrmConnect};

class AppModel extends Base\AbstractModel
{
    public $table = 'admin_app';
    public $fields = [
        'status' => ['type' => parent::BOOL, 'validate' => 'isBool'],
        'key' => ['required' => true, 'validate' => 'isGenericName'],
        'description' => ['type' => parent::HTML],
    ];

    public function get(): array
    {
        return $this->pdo->fetchAll(Yaconf::get('dicPdo.APP.GET_All'), [APP_LANG_ID]);
    }

    public function getIds(): array
    {
        return OrmConnect::getInstance($this->table)->select(['key', 'id'])->where(['status' => 1])->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function getDefaultId(string $name = null): int
    {
        $data = $this->getIds();
        return $data[$name] ?? $_SESSION[APP_NAME]['app_id'] ?? $data[APP_NAME];
    }
}
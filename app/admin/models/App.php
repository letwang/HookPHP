<?php
use Hook\Db\PdoConnect;
use Hook\Sql\App;

class AppModel extends AbstractModel
{
    public $table = 'hp_app';
    public $foreign = '';

    public function __construct()
    {
        parent::__construct();
    }

    public static function read(string $table, int $id = 0): array
    {
        return PdoConnect::getInstance()->fetchAll(App::GET_All, [$_SESSION[APP_NAME]['lang_id']]);
    }

    public function create(): int
    {
        return parent::create();
    }

    public function update(int $id): bool
    {
        return parent::update($id);
    }

    public function delete(int $id): int
    {
        return parent::delete($id);
    }
}
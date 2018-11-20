<?php
use Hook\Db\PdoConnect;
use Hook\Sql\App;

class AppModel extends AbstractModel
{
    public $table = 'hp_app';
    public $foreign = 'app_id';

    public $status;
    public $date_add;
    public $date_upd;
    public $name;
    public $description;

    public $fields = [];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function read(int $id = 0, int $langId = 0): array
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
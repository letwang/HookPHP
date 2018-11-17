<?php
namespace Hook;
use Hook\Db\PdoConnect;
use Hook\Sql\Hook;

class IndexModel extends \AbstractModel
{
    public $table = 'hp_hook';
    public $foreign = 'hook_id';

    public function __construct()
    {
        $this->validate = [];
        parent::__construct();
    }

    public function read(int $id = 0, int $langId = 0): array
    {
        return PdoConnect::getInstance()->fetchAll(Hook::GET_ALL, [$_SESSION[APP_NAME]['lang_id']]);
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
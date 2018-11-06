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

    public function all(): array
    {
        return PdoConnect::getInstance()->fetchAll(Hook::SQL_GET_ALL, [$_SESSION[APP_NAME]['lang_id']]);
    }

    public function add(): int
    {
        return parent::add();
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
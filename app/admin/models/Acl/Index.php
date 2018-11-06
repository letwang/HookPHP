<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl;

class IndexModel extends \AbstractModel
{
    public $table = '';
    public $foreign = '';

    public function __construct()
    {
        $this->validate = [];
        parent::__construct();
    }

    public function all(): array
    {
        return PdoConnect::getInstance()->fetchAll(Acl::SQL_GET_GROUP_RESOURCE, [$_SESSION[APP_NAME]['lang_id'], 1]);
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
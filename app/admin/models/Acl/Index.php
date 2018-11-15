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

    public static function read(string $table, int $id = 0): array
    {
        return PdoConnect::getInstance()->fetchAll(Acl::GET_GROUP_RESOURCE, [$_SESSION[APP_NAME]['lang_id'], 1]);
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
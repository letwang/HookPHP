<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl;

class ResourceModel extends \AbstractModel
{
    public $table = 'hp_acl_resource';
    public $foreign = 'resource_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function read(int $id = 0, int $langId = 0): array
    {
        return PdoConnect::getInstance()->fetchAll(Acl::GET_RESOURCE, [$_SESSION[APP_NAME]['lang_id'], 1]);
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
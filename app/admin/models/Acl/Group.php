<?php
namespace Acl;

class GroupModel extends \AbstractModel
{
    public $table = 'hp_acl_group';
    public $foreign = 'group_id';

    public function __construct()
    {
        $this->validate = [];
        parent::__construct();
    }

    public function add(): int
    {
        return parent::add();
    }

    public function update(int $id): bool
    {
        return parent::update($id);
    }

    public static function delete(int $id): int
    {
        return parent::delete($id);
    }
}
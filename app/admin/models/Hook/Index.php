<?php
namespace Hook;

class IndexModel extends \AbstractModel
{
    public $table = 'hp_hook';
    public $foreign = 'hook_id';

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
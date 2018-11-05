<?php
namespace User;

class IndexModel extends \AbstractModel
{
    public $table = 'hp_user';
    public $foreign = '';

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
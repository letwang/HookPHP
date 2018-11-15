<?php
namespace Hook;
use Hook\Db\Table;

class ModuleModel extends \AbstractModel
{
    public $table = 'hp_hook_module';
    public $foreign = '';

    public function __construct()
    {
        $this->validate = [];
        parent::__construct();
    }

    public static function read(string $table, int $id = 0): array
    {
        return parent::read($table, $id);
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
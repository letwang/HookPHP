<?php
use Hook\Db\Table;

class ConfigModel extends AbstractModel
{
    public $table = 'hp_config';
    public $foreign = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function all(): array
    {
        $data = new Table($this->table);
        return $data->read(['COLUMN' => '*']);
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
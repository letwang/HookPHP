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

    public function read(int $id = 0, int $langId = 0): array
    {
        return parent::get($this->table, $id, $langId);
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
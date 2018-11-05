<?php
use Hook\Db\Table;

class LangModel extends AbstractModel
{
    public $table = 'hp_lang';
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

    public function delete(int $id): int
    {
        return parent::delete($id);
    }
}
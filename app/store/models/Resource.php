<?php
class ResourceModel extends ObjectModel
{
    public $table = 'hp_acl_resource';
    public $foreign = 'resource_id';

    public function __construct()
    {
        $this->validate = [
            'app' => [
                'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['options' => ['regexp' => '/^[[:alpha:]]{'.APP_TABLE[$this->table]['app']['min'].','.APP_TABLE[$this->table]['app']['max'].'}$/']]
            ],
            'module' => [
                'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['options' => ['regexp' => '/^[[:alpha:]]{'.APP_TABLE[$this->table]['module']['min'].','.APP_TABLE[$this->table]['module']['max'].'}$/']]
            ],
            'controller' => [
                'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['options' => ['regexp' => '/^[[:alpha:]]{'.APP_TABLE[$this->table]['controller']['min'].','.APP_TABLE[$this->table]['controller']['max'].'}$/']]
            ],
            'action' => [
                'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['options' => ['regexp' => '/^[[:alpha:]]{'.APP_TABLE[$this->table]['action']['min'].','.APP_TABLE[$this->table]['action']['max'].'}$/']]
            ],
            'status' => [
                'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_INT,
                'options' => ['options' => ['min_range' => APP_TABLE[$this->table]['status']['min'], 'max_range' => 1]]
            ],
            'name' => [
                'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP, 'lang' => true,
                'options' => ['options' => ['regexp' => '/^[[:alpha:]]{'.APP_TABLE[$this->table.'_lang']['name']['min'].','.APP_TABLE[$this->table.'_lang']['name']['max'].'}$/u']]
            ]
        ];
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

    public function delete(int $id): bool
    {
        return parent::delete($id);
    }
}
<?php
class ResourceModel extends ObjectModel
{
    public $table = 'hp_acl_resource';
    public $foreign = 'resource_id';
    public $validate = [
        'app' => [
            'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['options' => ['regexp' => '/^[[:alpha:]]{1,16}$/']]
        ],
        'module' => [
            'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['options' => ['regexp' => '/^[[:alpha:]]{1,16}$/']]
        ],
        'controller' => [
            'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['options' => ['regexp' => '/^[[:alpha:]]{1,16}$/']]
        ],
        'action' => [
            'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['options' => ['regexp' => '/^[[:alpha:]]{1,16}$/']]
        ],
        'status' => [
            'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['options' => ['regexp' => '/^[0-1]$/']]
        ],
        'name' => [
            'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP, 'lang' => true,
            'options' => ['options' => ['regexp' => '/^[[:alpha:]]{1,32}$/u']]
        ]
    ];

    public function __construct()
    {
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
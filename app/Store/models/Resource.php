<?php
class ResourceModel extends ObjectModel
{
    public $table = 'hp_acl_resource';
    public $foreign = 'resource_id';
    public $validate = [
        'app' => [
            'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['options' => ['regexp' => '/^[[:alpha:]]*$/']]
        ],
        'module' => [
            'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['options' => ['regexp' => '/^[[:alpha:]]*$/']]
        ],
        'controller' => [
            'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['options' => ['regexp' => '/^[[:alpha:]]*$/']]
        ],
        'action' => [
            'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['options' => ['regexp' => '/^[[:alpha:]]*$/']]
        ],
        'status' => [
            'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_INT,
            'options' => ['options' => ['min_range' => 0, 'max_range' => 1]],
        ],
        'name' => [
            'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP, 'lang' => true,
            'options' => ['options' => ['regexp' => '/^[[:alpha:]]*$/u']]
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
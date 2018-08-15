<?php
class ResourceModel extends ObjectModel
{
    public $definition = [
        'table' => 'hp_acl_resource',
        'primary' => 'id',
        'fields' => [
            'app' => [
                'type' => INPUT_POST,
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => [
                    'options' => ['regexp' => '/^[[:alpha:]]*$/']
                ]
            ],
            'module' => [
                'type' => INPUT_POST,
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => [
                    'options' => ['regexp' => '/^[[:alpha:]]*$/']
                ]
            ],
            'controller' => [
                'type' => INPUT_POST,
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => [
                    'options' => ['regexp' => '/^[[:alpha:]]*$/']
                ]
            ],
            'action' => [
                'type' => INPUT_POST,
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => [
                    'options' => ['regexp' => '/^[[:alpha:]]*$/']
                ]
            ],
            'status' => [
                'type' => INPUT_POST,
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['options' => ['min_range' => 0, 'max_range' => 1]],
            ]
        ],
        'fieldsLang' => [
            'name' => [
                'type' => INPUT_POST,
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => [
                    'options' => ['regexp' => '/^[[:alpha:]]*$/u']
                ]
            ]
        ]
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        return parent::add();
    }

    public function update()
    {
        return parent::update();
    }

    public function delete()
    {
        return parent::delete();
    }
}
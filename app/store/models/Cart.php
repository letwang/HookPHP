<?php
class CartModel extends ObjectModel
{
    public $table = 'hp_cart';
    public $validate = [
        'id' => [
            'type' => INPUT_GET,
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['options' => ['min_range' => 1, 'max_range' => 10]]
        ],
        'title' => [
            'type' => INPUT_GET,
            'filter' => FILTER_DEFAULT,
            'options' => FILTER_REQUIRE_SCALAR
        ],
        'ip' => [
            'type' => INPUT_GET,
            'filter' => FILTER_VALIDATE_IP,
            'options' => ['flags'  => FILTER_FLAG_IPV4]
        ],
        'tag' => [
            'type' => INPUT_GET,
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['flags' => FILTER_REQUIRE_ARRAY, 'options' => ['min_range' => 100, 'max_range' => 200]],
        ],
        'version' => [
            'type' => INPUT_GET,
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => [
                'options' => ['regexp' => '/\b(old|new)\b/']
            ]
        ],
        'name' => [
            'type' => INPUT_GET,
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => [
                'options' => ['regexp' => '/^[[:alnum:]]*$/']
            ]
        ],
        'price' => [
            'type' => INPUT_GET,
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => [
                'options' => ['regexp' => '/^[[:digit:]]*$/']
            ]
        ]
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
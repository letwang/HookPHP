<?php
class IndexController extends InitController
{
    public $definition = [
        'index' => [
            'id' => [
                'type' => INPUT_GET,
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['options' => ['min_range' => 1, 'max_range' => 10]],
                'error' => '不能为空!'
            ]
        ],
        'list' => [
            'id' => [
                'type' => INPUT_GET,
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['options' => ['min_range' => 10, 'max_range' => 20]],
                'error' => '不能为空!'
            ]
        ]
    ];

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $this->_view->assign(
            ['test' => 'Index']
        );
    }

    public function listAction()
    {
        $this->_view->assign(
            ['test' => 'List']
        );
    }
}
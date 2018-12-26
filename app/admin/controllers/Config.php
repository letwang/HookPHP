<?php
class ConfigController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->fieldsList = [
            'id' => ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false],
            'app_id' => ['data' => 'app_id', 'className' => 'align-middle', 'title' => l('app.app_id')],
            'date_add' => ['data' => 'date_add', 'className' => 'align-middle', 'title' => l('app.date_add')],
            'date_upd' => ['data' => 'date_upd', 'className' => 'align-middle', 'title' => l('app.date_upd')],
            'key' => ['data' => 'key', 'className' => 'align-middle', 'title' => l('Config.key')],
            'value' => ['data' => 'value', 'className' => 'align-middle', 'title' => l('Config.value')],
            'idx' => ['data' => 'id', 'className' => 'align-middle text-right', 'orderable' => false, 'searchable' => false]
        ];
    }

    public function indexAction()
    {
        $this->_view->assign(['fieldsList' => $this->fieldsList]);
    }

    public function addAction()
    {
        $this->_view->assign(
            [
                'fields' => [
                    'title' => 'Form Add/Edit/...',
                    'form' => [
                        [
                            'form' => [
                                'legend' => [
                                    'image' => '/assets/vendor/jstree/themes/default/throbber.gif',
                                    'icon' => 'menu-link',
                                    'title' => 'brand',
                                ],
                                'description' => 'description...',
                                'warning' => 'warning...',
                                'success' => 'success...',
                                'error' => 'error...',
                                'input' => [
                                    [
                                        'class' => 'customClass',
                                        'type' => 'hidden',
                                        'name' => 'hidden'
                                    ],
                                    [
                                        'class' => 'customClass',
                                        'label' => 'label...',
                                        'required' => true,
                                        'hint' => 'hint...',
                                        'type' => 'text',
                                        'name' => 'text'
                                    ],
                                    [
                                        'class' => 'customClass',
                                        'label' => 'label...',
                                        'required' => true,
                                        'hint' => 'hint...',
                                        'type' => 'select',
                                        'name' => 'select',
                                        'options' => [
                                            'query' => array(
                                                [
                                                    'id' => 1,
                                                    'name' => 's1'
                                                ],
                                                [
                                                    'id' => 3,
                                                    'name' => 's3'
                                                ],
                                            ),
                                            'id' => 'id',
                                            'name' => 'name',
                                        ]
                                    ],
                                    [
                                        'class' => 'customClass',
                                        'label' => 'label...',
                                        'required' => true,
                                        'hint' => 'hint...',
                                        'type' => 'radio',
                                        'name' => 'radio',
                                        'values' => [
                                            [
                                                'id' => 10,
                                                'value' => 's10',
                                                'label' => 's10',
                                                'name' => 'radio',
                                                'disabled' => true
                                            ],
                                            [
                                                'id' => 11,
                                                'value' => 's11',
                                                'label' => 's11',
                                                'name' => 'radio',
                                                'disabled' => false
                                            ]
                                        ]
                                    ],
                                    [
                                        'class' => 'customClass',
                                        'label' => 'label...',
                                        'required' => true,
                                        'hint' => 'hint...',
                                        'type' => 'textarea',
                                        'name' => 'textarea'
                                    ]
                                ],
                            ]
                        ],
                        [
                            'form' => []
                        ]
                    ]
                ],
                'fieldsValue' => [],
                'showCancelButton' => true
            ]
        );
    }

    public function editAction()
    {
        $this->_view->assign(['id' => (int) $this->getRequest()->getParam('id')]);
    }
}
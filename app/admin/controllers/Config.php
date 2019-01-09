<?php
class ConfigController extends Base\ViewController
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

    public function postAction()
    {
        $this->_view->assign(
            [
                'fields' => [
                    'title' => l('app.add'),
                    'data' => [
                        [
                            'form' => [
                                'legend' => [
                                    'image' => '/assets/vendor/jstree/themes/default/throbber.gif',
                                    'icon' => 'menu-icon oi oi-infinity',
                                    'title' => 'legend...',
                                ],
                                'description' => 'description...',
                                'warning' => 'warning...',
                                'success' => 'success...',
                                'error' => 'error...',
                                'desc' => 'desc1...',
                                'desc' => [
                                    'desc2...',
                                    'desc3...',
                                    'desc4...'
                                ],
                                'desc' => [
                                    ['id' => 'desc5', 'text' => 'desc5...'],
                                    ['id' => 'desc6', 'text' => 'desc6...'],
                                    ['id' => 'desc7', 'text' => 'desc7...']
                                ],

                                // You can add 'desc' below each input...
                                'input' => [
                                    //demo 1:hidden
                                    [
                                        'class' => 'hiddenDemoClass',
                                        'type' => 'hidden',
                                        'name' => 'hidden1',
                                        'desc' => 'desc8...',
                                    ],

                                    //demo 2:text
                                    [
                                        'class' => 'textDemoClass',
                                        'type' => 'text',
                                        'name' => 'text2',
                                        'label' => 'Name',
                                        'hint' => 'Invalid characters: <;#',// ['A...','B...','C...']
                                        'col' => 9,
                                        'id' => 'text2',
                                        'size' => 90,
                                        'maxchar' => 10,
                                        'maxlength' => 10,
                                        'readonly' => false,
                                        'disabled' => false,
                                        'autocomplete' => false,
                                        'required' => true,
                                        'placeholder' => 'Pls input your name',
                                        'prefix' => 'https://',
                                        'suffix' => '@domain.com',
                                        'desc' => [
                                            ['id' => 'desc9', 'text' => 'desc9...'],
                                            ['id' => 'desc10', 'text' => 'desc10...'],
                                        ]
                                    ],

                                    //demo 3:select
                                    [
                                        'class' => 'selectDemoClass',
                                        'type' => 'select',
                                        'name' => 'select3',
                                        'label' => 'Group',
                                        'hint' => 'select3 hint...',
                                        'col' => 7,
                                        'id' => 'select3',
                                        'multiple' => true,
                                        'size' => 10,
                                        'onchange' => 'onchange',
                                        'disabled' => false,
                                        'values' => [
                                            [
                                                'label' => 'member',// Optional
                                                'options' => [
                                                    '1' => 'member1',
                                                    '2' => 'member2',
                                                    '3' => 'member3',
                                                ]
                                            ],
                                            [
                                                'options' => [
                                                    '4' => 'vip1',
                                                    '5' => 'vip2',
                                                    '6' => 'vip3',
                                                ]
                                            ]
                                        ]
                                    ],

                                    //demo 4:radio
                                    [
                                        'class' => 'radioDemoClass',
                                        'type' => 'radio',
                                        'name' => 'status',
                                        'label' => 'Status',
                                        'hint' => 'radio4 hint...',
                                        'col' => 6,
                                        'values' => [
                                            [
                                                'label' => 'enable',
                                                'tips' => 'enable...',
                                                'disabled' => false,
                                                'value' => 0,
                                            ],
                                            [
                                                'label' => 'disable',
                                                'tips' => 'disable...',
                                                'disabled' => false,
                                                'value' => 1,
                                            ]
                                        ]
                                    ],

                                    //demo 5:switch
                                    [
                                        'class' => 'switchDemoClass',
                                        'type' => 'switch',
                                        'name' => 'disable',
                                        'label' => 'Disable',
                                        'hint' => 'switch5 hint...',
                                        'col' => 5,
                                        'values' => [
                                            [
                                                'disabled' => false,
                                                'value' => 0,
                                            ],
                                            [
                                                'disabled' => false,
                                                'value' => 1,
                                            ]
                                        ]
                                    ],

                                    //demo 6:textarea
                                    [
                                        'class' => 'textareaDemoClass',
                                        'type' => 'textarea',
                                        'name' => 'textarea6',
                                        'label' => 'Description',
                                        'hint' => 'Length is not recommended too long...',// ['A...','B...','C...']
                                        'col' => 4,
                                        'id' => 'textarea6',
                                        'autoload_rte' => true,
                                        'readonly' => false,
                                        'cols' => 50,
                                        'rows' => 10,
                                        'maxlength' => 10,
                                        'maxchar' => 10
                                    ],

                                    //demo 7:checkbox
                                    [
                                        'class' => 'checkboxDemoClass',
                                        'type' => 'checkbox',
                                        'name' => 'checkbox7',
                                        'label' => 'Like',
                                        'hint' => 'What do you like...',// ['A...','B...','C...']
                                        'col' => 3,
                                        'id' => 'checkbox7',
                                        'expand' => [
                                            'default' => 'show',// hide
                                            'total' => '',
                                            'hide' => [
                                                'icon' => 'menu-icon oi oi-infinity',
                                                'text' => 'hide...'
                                            ],
                                            'show' => [
                                                'icon' => 'menu-icon oi oi-infinity',
                                                'text' => 'show...'
                                            ]
                                        ],
                                        'values' => [
                                            [
                                                'value' => 8,
                                                'label' => 'eight',
                                            ],
                                            [
                                                'value' => 9,
                                                'label' => 'nine',
                                            ]
                                        ]
                                    ],

                                    //demo 8:password
                                    [
                                        'class' => 'passwordDemoClass',
                                        'type' => 'password',
                                        'name' => 'password8',
                                        'label' => 'Password',
                                        'hint' => 'Your Password...',// ['A...','B...','C...']
                                        'col' => 2,
                                        'id' => 'password8',
                                        'autocomplete' => false,
                                        'required' => true
                                    ],

                                    //demo 9:birthday
                                    [
                                        'class' => 'birthdayDemoClass',
                                        'type' => 'birthday',
                                        'name' => 'birthday9',
                                        'label' => 'Birthday',
                                        'hint' => 'Your Birthday...',// ['A...','B...','C...']
                                        'col' => 9,
                                        'id' => 'birthday9',
                                        'values' => [
                                            'year' => range(1940, 2040),
                                            'month' => range(1, 12)
                                        ]
                                    ],

                                    //demo 10:color
                                    [
                                        'class' => 'colorDemoClass',
                                        'type' => 'color',
                                        'name' => 'color10',
                                        'label' => 'Color',
                                        'hint' => 'Your Color...',// ['A...','B...','C...']
                                        'col' => 8,
                                        'id' => 'color10'
                                    ],

                                    //demo 11:date
                                    [
                                        'class' => 'dateDemoClass',
                                        'type' => 'date',
                                        'name' => 'date11',
                                        'label' => 'Date',
                                        'hint' => 'Your Date...',// ['A...','B...','C...']
                                        'col' => 7,
                                        'id' => 'date11'
                                    ],

                                    //demo 12:datetime
                                    [
                                        'class' => 'datetimeDemoClass',
                                        'type' => 'datetime',
                                        'name' => 'datetime12',
                                        'label' => 'Datetime',
                                        'hint' => 'Your Datetime...',// ['A...','B...','C...']
                                        'col' => 6,
                                        'id' => 'datetime12'
                                    ]
                                ],
                                'submit' => [
                                    'name' => 'submit1',
                                    'class' => 'submitDemoClass',
                                    'icon' => 'menu-icon oi oi-infinity',
                                    'title' => 'Submit'
                                ],
                                'reset' => [
                                    'id' => 'reset1',
                                    'class' => 'resetDemoClass',
                                    'icon' => 'menu-icon oi oi-resize-both',
                                    'title' => 'Reset'
                                ],
                                'buttons' => [
                                    [
                                        'href' => 'javascript:void(0);',
                                        'id' => 'href1',
                                        'class' => 'hrefDemoClass',
                                        'js' => 'javascript:alert(2);',
                                        'icon' => 'menu-icon oi oi-wrench',
                                        'title' => 'Href'
                                    ],
                                    [
                                        'type' => 'button',
                                        'id' => 'button1',
                                        'name' => 'button1',
                                        'class' => 'buttonDemoClass',
                                        'js' => 'javascript:alert(3);',
                                        'icon' => 'menu-icon oi oi-infinity',
                                        'title' => 'Button'
                                    ]
                                ]
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
}
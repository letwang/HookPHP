<?php
class Acl_GroupController extends Base\ViewController
{
    public function init()
    {
        parent::init();
        $this->fieldsList = [
            'id' => ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false],
            'name' => ['data' => 'name', 'className' => 'align-middle', 'title' => l('Acl_Group.name')],
            'status' => ['data' => 'status', 'className' => 'align-middle', 'title' => l('app.status')],
            'date_add' => ['data' => 'date_add', 'className' => 'align-middle', 'title' => l('app.date_add')],
            'date_upd' => ['data' => 'date_upd', 'className' => 'align-middle', 'title' => l('app.date_upd')],
            'idx' => ['data' => 'id', 'className' => 'align-middle text-right', 'orderable' => false, 'searchable' => false]
        ];
        $this->formList = [
            'fields' => [
                'title' => l('app.add'),
                'data' => [
                    [
                        'form' => [
                            'input' => [
                                [
                                    'type' => 'switch',
                                    'name' => 'status',
                                    'label' => l('app.status'),
                                ],
                                [
                                    'type' => 'text',
                                    'name' => 'name',
                                    'label' => l('Acl_Group.name'),
                                    'required' => true,
                                    'maxchar' => APP_TABLE[Acl\GroupModel::$table.'_lang']['name']['max'],
                                ]
                            ],
                            'submit' => [
                                'name' => 'submit',
                                'class' => 'btn btn-primary',
                                'title' => 'Submit'
                            ],
                            'reset' => [
                                'id' => 'reset',
                                'class' => 'btn btn-warning',
                                'title' => 'Reset'
                            ]
                        ]
                    ]
                ]
            ],
            'fieldsValue' => [],
            'showCancelButton' => true
        ];
    }

    public function postAction()
    {
        $this->_view->assign($this->formList);
    }

    public function putAction()
    {
        $this->formList['fieldsValue'] = [
            'status' => AbstractModel::getData(Acl\GroupModel::$table, $this->id)['status'],
            'name' => [
                1 => AbstractModel::getData(Acl\GroupModel::$table.'_lang', $this->id, 1)['name'],
                2 => AbstractModel::getData(Acl\GroupModel::$table.'_lang', $this->id, 2)['name']
            ]
        ];
        $this->_view->assign($this->formList);
    }
}
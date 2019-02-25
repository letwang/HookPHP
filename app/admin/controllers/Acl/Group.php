<?php
class Acl_GroupController extends Base\ViewController
{
    /**
     *
     * @var Acl\GroupModel
     */
    protected $model;

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
                                    'maxchar' => APP_TABLE[$this->model::$table.'_lang']['name']['max'],
                                ]
                            ],
                            'buttons' => [
                                [
                                    'id' => 'submit',
                                    'class' => 'btn btn-primary',
                                    'title' => l('app.submit'),
                                    'js' => 'beforeSubmit();'
                                ]
                            ],
                            'reset' => [
                                'id' => 'reset',
                                'class' => 'btn btn-warning',
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
        $name = [];
        foreach (array_keys($this->languages) as $langId) {
            $name[$langId] = $this->model->getData(null, $this->id, $langId)['name'];
        }
        $this->formList['fieldsValue'] = [
            'status' => $this->model->getData(null, $this->id)['status'],
            'name' => $name
        ];
        $this->_view->assign($this->formList);
    }
}
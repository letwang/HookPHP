<?php
namespace Base;
abstract class ViewController extends InitController
{
    protected $fieldsList = [];
    protected $fieldsForm = [];

    protected function init()
    {
        parent::init();
        //全局模板路径
        $this->_view->setScriptPath(APP_ROOT.($this->_request->module === 'Index' ? '' : '/modules/'.$this->_request->module).'/views/'.APP_THEME);
        //全局META SEO
        $this->_view->assign(['title' => l('app.title'), 'keywords' => l('app.keywords'), 'description' => l('app.description')]);
        //初始化模板变量
        $this->_view->assign(
            [
                'id' => $this->id,
                'module' => $this->_request->module,
                'controller' => strtolower($this->_request->controller),
                'action' => $this->_request->action,
                'uri' => $this->_request->getRequestUri(),
                'languages' => $this->languages,
                'menus' => \MenuModel::getMenu()
            ]
        );
    }

    protected function postAction()
    {
        $this->renderForm();
        $this->_view->assign($this->fieldsForm);
    }

    protected function putAction()
    {
        $this->renderForm();
        foreach ($this->fieldsForm['fieldsValue'] as $field => &$value) {
            if ($value) {
                $value = [];
                foreach (array_keys($this->languages) as $langId) {
                    $value[$langId] = $this->model->getData(null, $this->id, $langId)[$field];
                }
            } else {
                $value = $this->model->getData(null, $this->id)[$field];
            }
        }
        $this->_view->assign($this->fieldsForm);
    }

    protected function getAction()
    {
        $this->renderList();
        $this->_view->assign(['fieldsList' => $this->fieldsList]);
    }

    protected function getDefinition(array $ignore = null): array
    {
        $data = APP_TABLE[$this->model::$table];
        foreach (APP_TABLE[$this->model::$table.'_lang'] ?? [] as $field => $desc) {
            $data[$field] = $desc + ['lang' => true];
        }
        return array_diff_key($data, $ignore);
    }

    protected function renderList()
    {
        $ignore = ['status' => true, 'date_add' => true, 'date_upd' => true];
        $this->fieldsList['id'] = ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false];
        if ($this->model) {
            foreach (array_keys($this->getDefinition(['id' => true, 'app_id' => true, 'lang_id' => true, $this->model::$foreign => true])) as $field) {
                $this->fieldsList[$field] = [
                    'data' => $field,
                    'className' => 'align-middle',
                    'title' => l((isset($ignore[$field]) ? 'app' : $this->_request->controller).'.'.$field)
                ];
            }
        }
        $this->fieldsList['idx'] = ['className' => 'align-middle text-right'] + $this->fieldsList['id'];
    }

    protected function renderForm()
    {
        $input = [];
        $fieldsValue = [];
        foreach ($this->getDefinition($this->model->ignore) as $field => $desc) {
            $config = [
                'name' => $field,
                'label' => l($this->_request->controller.'.'.$field),
                'lang' => isset($desc['lang']),
                'required' => $desc['default'] === ''
            ];
            $table = $config['lang'] ? $this->model::$table.'_lang' : $this->model::$table;
            $fieldsValue[$field] = $config['lang'];
            switch (1) {
                case $desc['type'] === 'tinyint':
                    $config += [
                    'type' => 'switch',
                    ];
                    break;
                case strpos($desc['type'], 'char') !== false:
                default:
                    $config += [
                    'type' => 'text',
                    'maxchar' => APP_TABLE[$table][$field]['max']
                    ];
                    break;
            }
            $input[$field] = $config;
        }
        $this->fieldsForm += [
            'fields' => [
                'title' => l($this->_request->controller.'.'.$this->_request->action),
                'data' => [
                    [
                        'form' => [
                            'input' => $input,
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
            'fieldsValue' => $fieldsValue,
            'showCancelButton' => true
        ];
    }
}
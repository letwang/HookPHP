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
        $this->_view->setScriptPath(APP_CONFIG['application']['directory'].($this->_request->module === 'Index' ? '' : '/modules/'.$this->_request->module).'/views/'.APP_THEME_NAME);
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
            ]
        );

        if (isset($_SESSION[APP_NAME])) {
            $this->_view->assign(
                [
                    'menus' => \MenuModel::getMenu()
                ]
            );
        }
    }

    protected function postAction()
    {
        $this->renderForm();
        $this->_view->assign($this->fieldsForm);
    }

    protected function putAction()
    {
        $this->renderForm();
        $this->setFieldsValue();
        $this->_view->assign($this->fieldsForm);
    }

    protected function getAction()
    {
        $this->renderList();
        $this->_view->assign(['fieldsList' => $this->fieldsList]);
    }

    protected function setFieldsValue(): void
    {
        foreach ($this->fieldsForm['fields']['data'][0]['form']['input'] as $field => $input) {
            if ($input['lang']) {
                foreach (array_keys($this->languages) as $langId) {
                    $this->fieldsForm['fieldsValue'][$field][$langId] = $this->model->getData(null, $this->id, $langId)[$field];
                }
            } else {
                $this->fieldsForm['fieldsValue'][$field] = $this->model->getData(null, $this->id)[$field];
            }
        }
    }

    protected function getDefinition(array $ignore = []): array
    {
        $data = APP_TABLE[$this->model::$table];
        foreach (APP_TABLE[$this->model::$table.'_lang'] ?? [] as $field => $desc) {
            $data[$field] = $desc + ['lang' => true];
        }
        return array_diff_key($data, $ignore);
    }

    protected function renderList(): void
    {
        $white = ['status' => true, 'date_add' => true, 'date_upd' => true];
        $this->fieldsList['id'] = ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false];
        if ($this->model) {
            $ignore = $this->model->ignore;
            unset($ignore['date_add'], $ignore['date_upd']);
            foreach (array_keys($this->getDefinition($ignore)) as $field) {
                $this->fieldsList[$field] = [
                    'data' => $field,
                    'className' => 'align-middle',
                    'title' => l((isset($white[$field]) ? 'app' : $this->_request->controller).'.'.$field)
                ];
            }
        }
        $this->fieldsList['idx'] = ['className' => 'align-middle text-right'] + $this->fieldsList['id'];
    }

    protected function renderForm(): void
    {
        $input = [];
        foreach ($this->getDefinition($this->model->ignore) as $field => $desc) {
            $input[$field] = [
                'name' => $field,
                'label' => l($this->_request->controller.'.'.$field),
                'lang' => isset($desc['lang']),
                'required' => $desc['default'] === ''
            ];
            $table = $input[$field]['lang'] ? $this->model::$table.'_lang' : $this->model::$table;
            switch (1) {
                case $desc['type'] === 'tinyint':
                    $input[$field] += [
                    'type' => (int) $desc['max'] === 1 ? 'switch' : 'number',
                    ];
                    break;
                case strpos($desc['type'], 'char') !== false:
                default:
                    $input[$field] += [
                    'type' => 'text',
                    'maxchar' => APP_TABLE[$table][$field]['max']
                    ];
                    break;
            }
        }
        $this->fieldsForm = [
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
            'fieldsValue' => [],
            'showCancelButton' => true
        ];
    }
}
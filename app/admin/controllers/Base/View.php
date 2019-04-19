<?php
namespace Base;
abstract class ViewController extends AbstractController
{
    protected $list = [];
    protected $form = [];
    protected $ignore = [];

    protected function init()
    {
        parent::init();
        $this->ignore = $this->model->ignore;
        $this->_view->setScriptPath(APP_CONFIG['application']['directory'].($this->_request->module === 'Index' ? '' : '/modules/'.$this->_request->module).'/views/'.APP_THEME_NAME);
        $this->_view->assign(
            [
                'title' => l('app.title'),
                'keywords' => l('app.keywords'),
                'description' => l('app.description'),

                'id' => $this->id,
                'languages' => $this->languages,

                'module' => $this->_request->module,
                'controller' => strtolower($this->_request->controller),
                'action' => $this->_request->action,
                'uri' => $this->_request->getRequestUri(),
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
        $this->_view->assign($this->form);
    }

    protected function putAction()
    {
        $this->renderForm();
        $this->setValue();
        $this->_view->assign($this->form);
    }

    protected function getAction()
    {
        $this->renderList();
        $this->_view->assign(['list' => $this->list]);
    }

    protected function setValue(): void
    {
        foreach ($this->form['fields']['data'][0]['form']['input'] as $field => $input) {
            if ($input['lang']) {
                foreach ($this->languages as $language) {
                    $this->form['value'][$field][$language['id']] = $this->model->getData($this->model::$table.'_lang', $this->id, $language['id'])[$field];
                }
            } else {
                $this->form['value'][$field] = $this->model->getData(null, $this->id)[$field];
            }
        }
    }

    protected function getDefinition(): array
    {
        if (!$this->model::$table) {
            return [];
        }

        $data = APP_TABLE[$this->model::$table];
        foreach (APP_TABLE[$this->model::$table.'_lang'] ?? [] as $field => $desc) {
            $data[$field] = $desc + ['lang' => true];
        }
        return array_diff_key($data, $this->ignore);
    }

    protected function renderList(): void
    {
        $white = ['status' => true, 'date_add' => true, 'date_upd' => true];
        $this->list['id'] = ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false];
        unset($this->ignore['date_add'], $this->ignore['date_upd']);
        foreach (array_keys($this->getDefinition()) as $field) {
            $this->list[$field] = [
                'data' => $field,
                'className' => 'align-middle',
                'title' => l((isset($white[$field]) ? 'app' : $this->_request->controller).'.'.$field)
            ];
        }
        $this->list['idx'] = ['className' => 'align-middle text-right'] + $this->list['id'];
    }

    protected function renderForm(): void
    {
        $input = [];
        foreach ($this->getDefinition() as $field => $desc) {
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
        $this->form = [
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
            'value' => [],
            'showCancel' => true
        ];
    }
}
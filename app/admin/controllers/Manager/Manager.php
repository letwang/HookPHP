<?php
class Manager_ManagerController extends Base\ViewController
{
    protected function renderList(): void
    {
        $this->ignore += ['pass' => true];
        parent::renderList();
    }

    protected function renderForm(): void
    {
        parent::renderForm();
        $this->form['fields']['data'][0]['form']['input']['app_id'] = [
            'type' => 'select',
            'name' => 'app_id',
            'label' => l($this->_request->controller.'.app_id'),
            'lang' => false,
            'values' => [['options' => array_flip(AppModel::getInstance()->getIds())]]
        ];
    }
}
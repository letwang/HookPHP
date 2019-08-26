<?php
use Hook\HookModel;
use Hook\ModuleModel;

class Hook_Hook_ModuleController extends Base\ViewController
{
    protected function renderForm(): void
    {
        parent::renderForm();
        $this->form['fields']['data'][0]['form']['input']['hook_id'] = [
            'type' => 'select',
            'name' => 'hook_id',
            'label' => l($this->_request->controller.'.hook_id'),
            'lang' => false,
            'values' => [['options' => HookModel::getInstance($this->id)->getSelect()]]
        ];
        $this->form['fields']['data'][0]['form']['input']['module_id'] = [
            'type' => 'select',
            'name' => 'module_id',
            'label' => l($this->_request->controller.'.module_id'),
            'lang' => false,
            'values' => [['options' => ModuleModel::getInstance($this->id)->getSelect()]]
        ];
    }
}
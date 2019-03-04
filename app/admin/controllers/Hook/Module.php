<?php
use Hook\{HookModel, ModuleModel};

class Hook_ModuleController extends Base\ViewController
{
    public function init()
    {
        parent::init();
    }

    protected function renderForm(): void
    {
        parent::renderForm();
        $this->fieldsForm['fields']['data'][0]['form']['input']['hook_id'] = [
            'type' => 'select',
            'name' => 'hook_id',
            'label' => l($this->_request->controller.'.hook_id'),
            'lang' => false,
            'values' => [['options' => (new HookModel())->getSelect()]]
        ];
        $this->fieldsForm['fields']['data'][0]['form']['input']['module_id'] = [
            'type' => 'select',
            'name' => 'module_id',
            'label' => l($this->_request->controller.'.module_id'),
            'lang' => false,
            'values' => [['options' => (new ModuleModel())->getSelect()]]
        ];
    }
}
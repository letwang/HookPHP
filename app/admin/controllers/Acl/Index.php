<?php
use Acl\{GroupModel, ResourceModel};

class Acl_IndexController extends Base\ViewController
{
    public function init()
    {
        parent::init();
    }

    protected function renderForm(): void
    {
        parent::renderForm();
        $this->fieldsForm['fields']['data'][0]['form']['input']['group_id'] = [
            'type' => 'select',
            'name' => 'group_id',
            'label' => l($this->_request->controller.'.group_id'),
            'lang' => false,
            'values' => [['options' => (new GroupModel())->getSelect()]]
        ];
        $this->fieldsForm['fields']['data'][0]['form']['input']['resource_id'] = [
            'type' => 'select',
            'name' => 'resource_id',
            'label' => l($this->_request->controller.'.resource_id'),
            'lang' => false,
            'values' => [['options' => (new ResourceModel())->getSelect()]]
        ];
    }
}
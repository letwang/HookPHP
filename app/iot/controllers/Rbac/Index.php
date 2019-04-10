<?php
use Acl\{GroupModel, ResourceModel};

class Rbac_IndexController extends Base\ViewController
{
    protected function renderForm(): void
    {
        parent::renderForm();
        $this->form['fields']['data'][0]['form']['input']['group_id'] = [
            'type' => 'select',
            'name' => 'group_id',
            'label' => l($this->_request->controller.'.group_id'),
            'lang' => false,
            'values' => [['options' => GroupModel::getInstance($this->id)->getSelect()]]
        ];
        $this->form['fields']['data'][0]['form']['input']['resource_id'] = [
            'type' => 'select',
            'name' => 'resource_id',
            'label' => l($this->_request->controller.'.resource_id'),
            'lang' => false,
            'values' => [['options' => ResourceModel::getInstance($this->id)->getSelect()]]
        ];
    }
}
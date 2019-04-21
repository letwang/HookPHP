<?php
use Rbac\{GroupModel, RoleModel};

class Rbac_Group_RoleController extends Base\ViewController
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
        $this->form['fields']['data'][0]['form']['input']['role_id'] = [
            'type' => 'select',
            'name' => 'role_id',
            'label' => l($this->_request->controller.'.role_id'),
            'lang' => false,
            'values' => [['options' => RoleModel::getInstance($this->id)->getSelect()]]
        ];
    }
}
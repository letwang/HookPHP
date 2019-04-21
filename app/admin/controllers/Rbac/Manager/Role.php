<?php
use Manager\ManagerModel;
use Rbac\RoleModel;

class Rbac_Manager_RoleController extends Base\ViewController
{
    protected function renderForm(): void
    {
        parent::renderForm();
        $this->form['fields']['data'][0]['form']['input']['manager_id'] = [
            'type' => 'select',
            'name' => 'manager_id',
            'label' => l($this->_request->controller.'.manager_id'),
            'lang' => false,
            'values' => [['options' => ManagerModel::getInstance($this->id)->getSelect()]]
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
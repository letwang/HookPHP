<?php
use Acl\{UserModel, RoleModel};

class Acl_UserController extends Base\ViewController
{
    protected function renderForm(): void
    {
        parent::renderForm();
        $this->form['fields']['data'][0]['form']['input']['user_id'] = [
            'type' => 'select',
            'name' => 'user_id',
            'label' => l($this->_request->controller.'.user_id'),
            'lang' => false,
            'values' => [['options' => UserModel::getInstance($this->id)->getSelect()]]
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
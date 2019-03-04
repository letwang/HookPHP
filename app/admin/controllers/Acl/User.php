<?php
class Acl_UserController extends Base\ViewController
{
    public function init()
    {
        parent::init();
    }

    protected function renderForm(): void
    {
        parent::renderForm();
        $this->fieldsForm['fields']['data'][0]['form']['input']['user_id'] = [
            'type' => 'select',
            'name' => 'user_id',
            'label' => l($this->_request->controller.'.user_id'),
            'lang' => false,
            'values' => [['options' => (new Acl\UserModel())->getSelect()]]
        ];
        $this->fieldsForm['fields']['data'][0]['form']['input']['role_id'] = [
            'type' => 'select',
            'name' => 'role_id',
            'label' => l($this->_request->controller.'.role_id'),
            'lang' => false,
            'values' => [['options' => (new Acl\RoleModel())->getSelect()]]
        ];
    }
}
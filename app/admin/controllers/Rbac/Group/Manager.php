<?php
use Rbac\GroupModel;
use Manager\ManagerModel;

class Rbac_Group_ManagerController extends Base\ViewController
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
        $this->form['fields']['data'][0]['form']['input']['manager_id'] = [
            'type' => 'select',
            'name' => 'manager_id',
            'label' => l($this->_request->controller.'.manager_id'),
            'lang' => false,
            'values' => [['options' => ManagerModel::getInstance($this->id)->getSelect()]]
        ];
    }
}
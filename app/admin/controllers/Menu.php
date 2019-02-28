<?php
class MenuController extends Base\ViewController
{
    /**
     * 
     * @var MenuModel
     */
    protected $model;

    public function init()
    {
        parent::init();
    }

    protected function renderForm(): void
    {
        parent::renderForm();
        $this->fieldsForm['fields']['data'][0]['form']['input']['parent'] = [
            'type' => 'select',
            'name' => 'parent',
            'label' => l($this->_request->controller.'.parent'),
            'lang' => false,
            'values' => [['options' => $this->model->getSelect()]]
        ];
        $this->fieldsForm['fields']['data'][0]['form']['input']['position'] = [
            'type' => 'number',
            'name' => 'position',
            'label' => l($this->_request->controller.'.position'),
            'lang' => false,
        ];
    }
}
<?php
use Yaf\Controller_Abstract;

class InitController extends Controller_Abstract
{
    public $result = [];
    public $definition = [];

    public function init()
    {
        $this->_view->assign(['title' => l('application.title'), 'keywords' => l('application.keywords'), 'description' => l('application.description')]);

        if (!isset($this->definition[$this->_request->action])) {
            return false;
        }
        foreach ($this->definition[$this->_request->action] as $field => $filter) {
            $result = filter_input($filter['type'], $field, $filter['filter'], $filter['options']);
            if ($result === false || $result === null) {
                throw new \InvalidArgumentException(l(get_called_class().'.'.$field.'.validate.error'));
            }

            $this->result[$field] = $result;
        }
    }
}
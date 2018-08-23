<?php
use Yaf\Controller_Abstract;

class InitController extends Controller_Abstract
{
    public $result = [];
    public $definition = [];

    public function init()
    {
        $this->_view->assign(
            [
                'title' => 'HookPHP是一款基于PHP7的老司机专用PHP框架',
                'keywords' => '上手快、成本低、PHP7起步、重安全、高性能、SEO优化',
                'description' => '这是一款出自10年+编程经验者创造的PHP框架！'
            ]
        );

        if (!isset($this->definition[$this->_request->action])) {
            return false;
        }
        foreach ($this->definition[$this->_request->action] as $field => $filter) {
            $result = filter_input($filter['type'], $field, $filter['filter'], $filter['options']);
            if ($result === false || $result === null) {
                throw new \InvalidArgumentException('Field '.$field.' '.($filter['error'] ?? 'error.'));
            }

            $this->result[$field] = $result;
        }
    }
}
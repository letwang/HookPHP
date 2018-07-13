<?php
use Yaf\Controller_Abstract;

class InitController extends Controller_Abstract
{

    public function init()
    {
        $this->_view->assign(
            [
                'title' => 'HookPHP是一款基于PHP7的老司机专用PHP框架',
                'keywords' => '上手快、成本低、PHP7起步、重安全、高性能、SEO优化',
                'description' => '这是一款出自10年+编程经验者创造的PHP框架！'
            ]
        );
    }
}
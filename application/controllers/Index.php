<?php
class IndexController extends Yaf\Controller_Abstract {
    public function indexAction() {
        $this->_view->word = "hello world";
    }
}
<?php
class IndexController extends AbstractController
{
    public function getAction()
    {
        $this->_view->assign(['fieldsList' => $this->fieldsList]);
    }

    public function postAction()
    {
        //
    }

    public function putAction()
    {
        $this->_view->assign(['id' => (int) $this->getRequest()->getParam('id')]);
    }
}
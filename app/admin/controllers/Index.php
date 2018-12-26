<?php
class IndexController extends AbstractController
{
    public function indexAction()
    {
        $this->_view->assign(['fieldsList' => $this->fieldsList]);
    }

    public function addAction()
    {
        //
    }

    public function editAction()
    {
        $this->_view->assign(['id' => (int) $this->getRequest()->getParam('id')]);
    }
}
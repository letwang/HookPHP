<?php
class AclController extends InitController
{
    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $this->_view->assign(['test' => 'ACL']);
    }

    public function postAction()
    {
        $resourceModel = new ResourceModel();
        return $resourceModel->add();
    }
}
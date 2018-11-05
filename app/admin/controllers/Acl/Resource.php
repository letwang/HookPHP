<?php
class Acl_ResourceController extends AbstractController
{
    public function indexAction()
    {
        $this->_view->assign(['test' => $this->_name]);
    }

    public function postAction()
    {
        $resource = new Acl\ResourceModel();
        $resource->add();
    }
}
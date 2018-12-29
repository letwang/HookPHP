<?php
class TranslationController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new TranslationModel($this->getRequest()->getParam('id'));
    }

    public function getAction()
    {
        return $this->send($this->model->get());
    }

    public function postAction()
    {
        return $this->send($this->model->post());
    }

    public function putAction()
    {
        return $this->send($this->model->put());
    }

    public function deleteAction()
    {
        return $this->send($this->model->delete());
    }
}
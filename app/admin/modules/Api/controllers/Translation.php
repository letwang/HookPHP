<?php
class TranslationController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new TranslationModel($this->getRequest()->getParam('id'));
    }

    public function GETAction()
    {
        return $this->send($this->model->get());
    }

    public function POSTAction()
    {
        return $this->send($this->model->create());
    }

    public function PUTAction()
    {
        return $this->send($this->model->update());
    }

    public function DELETEAction()
    {
        return $this->send($this->model->delete());
    }
}
<?php
use Hook\Db\Table;

class ConfigController extends AbstractController
{
    public function GETAction()
    {
        $data = new Table('hp_config');
        return $this->send($data->read(['COLUMN' => '*']));
    }

    public function POSTAction()
    {
        return $this->send();
    }

    public function PUTAction()
    {
        return $this->send();
    }

    public function DELETEAction()
    {
        return $this->send();
    }
}
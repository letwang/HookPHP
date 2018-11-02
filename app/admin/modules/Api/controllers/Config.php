<?php
use Hook\Db\Table;

class ConfigController extends AbstractController
{
    public function indexAction()
    {
        $data = new Table('hp_config');
        exit($this->send($data->read(['COLUMN' => '*'])));
    }
}
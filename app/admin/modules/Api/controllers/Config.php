<?php
declare(strict_types=1);

class ConfigController extends Base\ApiController
{
    public function getAction()
    {
        return $this->send($this->model->get());
    }
}
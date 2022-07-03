<?php
declare(strict_types=1);

class ZoneController extends Base\ApiController
{
    public function getAction()
    {
        return $this->send($this->model->get());
    }
}
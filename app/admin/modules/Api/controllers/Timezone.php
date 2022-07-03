<?php
declare(strict_types=1);

class TimezoneController extends Base\ApiController
{
    public function getAction()
    {
        return $this->send($this->model->get());
    }
}
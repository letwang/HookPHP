<?php
declare(strict_types=1);

class StateController extends Base\ApiController
{
    public function getAction()
    {
        return $this->send($this->model->get());
    }
}
<?php
declare(strict_types=1);

class Rbac_GroupController extends Base\ApiController
{
    public function getAction()
    {
        return $this->send($this->model->get());
    }
}
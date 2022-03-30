<?php
declare(strict_types=1);

class Rbac_RoleController extends Base\ApiController
{
    public function getAction()
    {
        return $this->send($this->model->get());
    }
}
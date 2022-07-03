<?php
declare(strict_types=1);

class CountryController extends Base\ApiController
{
    public function getAction()
    {
        return $this->send($this->model->get());
    }
}
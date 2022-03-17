<?php
declare(strict_types=1);

class ErrorController extends Base\ViewController
{
    public function errorAction($exception)
    {
        $this->_view->exception = $exception;
    }
}
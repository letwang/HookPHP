<?php
class ErrorController extends BaseController
{
    public function errorAction($exception)
    {
        $this->_view->exception = $exception;
    }
}
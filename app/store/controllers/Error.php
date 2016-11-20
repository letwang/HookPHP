<?php

class ErrorController extends InitController
{

    public function errorAction($exception)
    {
        $this->_view->exception = $exception;
    }
}
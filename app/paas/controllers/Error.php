<?php
class ErrorController extends AbstractController
{
    public function errorAction($exception)
    {
        $this->_view->exception = $exception;
    }
}
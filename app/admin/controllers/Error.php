<?php
declare(strict_types=1);

class ErrorController extends Base\ViewController
{
    public function errorAction($exception)
    {
        switch ($exception->getCode()) {
            case YAF\ERR\NOTFOUND\MODULE:
            case YAF\ERR\NOTFOUND\CONTROLLER:
            case YAF\ERR\NOTFOUND\ACTION:
            case YAF\ERR\NOTFOUND\VIEW:
                $status = 404;
                break;
            default:
                $status = 500;
                break;
        }
        if ($this->getRequest()->isXmlHttpRequest()) {
            return $this->send((array) $exception, 'throwableCatch', $status);
        }
        $this->_view->exception = $exception;
    }
}
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
            return $this->send([
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
            ], 0, 'throwableCatch', $status);
        }
        $this->_view->exception = $exception;
    }
}
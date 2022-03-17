<?php
declare(strict_types=1);

class LogoutController extends Base\ApiController
{
    public function getAction()
    {
        session_destroy();
        self::send();
    }
}
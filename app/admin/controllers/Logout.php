<?php
declare(strict_types=1);

class LogoutController extends Base\ViewController
{
    public function getAction()
    {
        session_regenerate_id(true);
        session_destroy();
    }
}
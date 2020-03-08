<?php
namespace Hook\Hook;

use Hook\Cache\Cache;

class Module extends Cache
{
    public object $module;

    public function __construct(string $module)
    {
        require APP_CONFIG['application']['directory'].'/hooks/'.$module.'/'.$module.'.php';
        $this->module = new $module;
    }
}
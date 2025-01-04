<?php
use Yaf\{Dispatcher, Bootstrap_Abstract};

class Bootstrap extends Bootstrap_Abstract {
    public function _initConfig(Dispatcher $dispatcher) {
        $dispatcher->registerPlugin(new HookPlugin());
    }
}

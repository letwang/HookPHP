<?php
declare(strict_types=1);

use Yaf\{Plugin_Abstract, Request_Abstract, Response_Abstract};
use Hook\Hook\Hook;

class HookPlugin extends Plugin_Abstract
{
    public function routerStartup(Request_Abstract $request, Response_Abstract $response)
    {
        //Hook::run('routerStartup', ['request' => $request, 'response' => $response]);
    }

    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        //Hook::run('routerShutdown', ['request' => $request, 'response' => $response]);
    }

    public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response)
    {
        //Hook::run('dispatchLoopStartup', ['request' => $request, 'response' => $response]);
    }

    public function preDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        //Hook::run('preDispatch', ['request' => $request, 'response' => $response]);
    }
    
    // now, begin some controller method:init、action

    public function postDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        //Hook::run('postDispatch', ['request' => $request, 'response' => $response]);
    }

    public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        //Hook::run('dispatchLoopShutdown', ['request' => $request, 'response' => $response]);
    }
    
    // do it before Response
    public function preResponse(Request_Abstract $request, Response_Abstract $response)
    {
        //Hook::run('preResponse', ['request' => $request, 'response' => $response]);
    }
}
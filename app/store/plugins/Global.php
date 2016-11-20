<?php
use Yaf\Plugin_Abstract, Yaf\Request_Abstract, Yaf\Response_Abstract;

class GlobalPlugin extends Plugin_Abstract
{

    public function routerStartup(Request_Abstract $request, Response_Abstract $response)
    {}

    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {}

    public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response)
    {}

    public function preDispatch(Request_Abstract $request, Response_Abstract $response)
    {}
    
    // controller init method
    public function postDispatch(Request_Abstract $request, Response_Abstract $response)
    {}

    public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response)
    {}
    
    // do it before Response
    public function preResponse(Request_Abstract $request, Response_Abstract $response)
    {}
}
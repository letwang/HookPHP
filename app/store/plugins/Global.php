<?php
use Yaf\Plugin_Abstract, Yaf\Request_Abstract, Yaf\Response_Abstract, Yaf\Session;
use Let\Http\Header;

class GlobalPlugin extends Plugin_Abstract
{

    public function routerStartup(Request_Abstract $request, Response_Abstract $response)
    {
        //
    }

    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        $referer = $request->getServer('REQUEST_URI', APP_CONFIG['HTTP_URI']);
        
        if (Session::getInstance()->has(LoginController::SESSIONNAME) === false) {
            if ($request->controller === 'Login') {
                // static
            } else {
                Header::redirect('login/?referer=' . $referer);
            }
            return false;
        }
        
        if ($request->controller === 'Login') {
            $referer = str_replace('login/?referer=', '', $referer, $count);
            $referer = $count ? $referer : '/';
            
            Header::redirect($referer);
            return false;
        }
    }

    public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response)
    {
        //
    }

    public function preDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        //
    }
    
    // controller init method
    public function postDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        //
    }

    public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        //
    }
    
    // do it before Response
    public function preResponse(Request_Abstract $request, Response_Abstract $response)
    {
        //
    }
}
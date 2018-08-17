<?php
use Yaf\{Plugin_Abstract, Request_Abstract, Response_Abstract, Session};
use Hook\Http\Header;
use Hook\Hook\Hook;
use Hook\Crypt\Rijndael;

class GlobalPlugin extends Plugin_Abstract
{

    public function routerStartup(Request_Abstract $request, Response_Abstract $response)
    {
        Hook::run('routerStartup', ['request' => $request, 'response' => $response]);
    }

    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        Hook::run('routerShutdown', ['request' => $request, 'response' => $response]);

        //Auth
        $referer = $request->getServer('REQUEST_URI', APP_CONFIG['HTTP_URI']);
        
        if (Session::getInstance()->has('user') === false) {
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
        Hook::run('dispatchLoopStartup', ['request' => $request, 'response' => $response]);
    }

    public function preDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        Hook::run('preDispatch', ['request' => $request, 'response' => $response]);
    }
    
    // now, begin some controller method

    public function postDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        Hook::run('postDispatch', ['request' => $request, 'response' => $response]);
    }

    public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        Hook::run('dispatchLoopShutdown', ['request' => $request, 'response' => $response]);
    }
    
    // do it before Response
    public function preResponse(Request_Abstract $request, Response_Abstract $response)
    {
        Hook::run('preResponse', ['request' => $request, 'response' => $response]);
    }
}
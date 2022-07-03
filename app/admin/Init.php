<?php
declare(strict_types=1);

isset($_SERVER['REQUEST_ID']) && SeasLog::setRequestID($_SERVER['REQUEST_ID']);

set_error_handler(
    function($level, $error, $file, $line){
        if(0 === error_reporting()){
            return false;
        }
        throw new ErrorException($error, -1, $level, $file, $line);
    },
    E_ALL
);

register_shutdown_function(function(){
    $error = error_get_last();
    if($error){
        throw new ErrorException($error['message'], -1, $error['type'], $error['file'], $error['line']);
    }
});

set_exception_handler(function($exception){
    exit(PHP_SAPI === 'cli' ? $exception : '<!doctype html>
<html lang="en-us">
<head>
<meta charset="utf-8">
<meta name="author" content="LetWang">
<meta name="generator" content="HookPHP">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Internal Server Error</title>
<link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
</head>
<body class="loading authentication-bg" data-layout-config=\'{"darkMode":false}\'>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <a href="/"><span><img src="https://getbootstrap.com/docs/5.1/assets/brand/bootstrap-logo.svg" height="18"></span></a>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <img src="/assets/images/startman.svg" height="120" alt="File not found Image">
                                <h1 class="text-error mt-4">500</h1>
                                <p class="text-danger mt-3">'.$exception.'</p>
                                <p class="text-muted mt-3">Why not try refreshing your page? or you can contact <a href="/" class="text-muted"><b>Support</b></a></p>
                                <a class="btn btn-info mt-3" href="/"><i class="mdi mdi-reply"></i> Return Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<footer class="footer footer-alt">2018 - <script>document.write(new Date().getFullYear())</script> © HookPHP - Request ID:'.SeasLog::getRequestID().'</footer>
<script src="/assets/js/vendor.min.js"></script><script src="/assets/js/app.min.js"></script></body></html>');
});

define('APP_NAME', 'iot');
define('APP_CONFIG', apcu_fetch('admin')[YAF\ENVIRON]);
define('APP_TABLE', apcu_fetch('admin')['table'] + apcu_fetch(APP_NAME)['table']);

require __DIR__.'/../../vendor/autoload.php';

$app = new Yaf\Application(['application' => APP_CONFIG['application']]);
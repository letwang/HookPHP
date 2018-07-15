<?php
class One
{
    public function hookRouterStartup($args)
    {
        //
    }

    public function hookRouterShutdown($args)
    {
        //
    }

    public function hookDispatchLoopStartup($args)
    {
        //
    }

    public function hookPreDispatch($args)
    {
        //
    }

    public function hookPostDispatch($args)
    {
        //
    }

    public function hookDispatchLoopShutdown($args)
    {
        //
    }

    public function hookPreResponse($args)
    {
        //
    }

    public function hookDisplayTop($args)
    {
        return '这是One模块，显示在Top<br />';
    }

    public function hookDisplayHead($args)
    {
        return '这是One模块，显示在Head<br />';
    }

    public function hookDisplayFoot($args)
    {
        return '这是One模块，显示在Foot<br />';
    }
}
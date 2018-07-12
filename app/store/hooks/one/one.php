<?php
class One
{
    public function hookDisplayTop($params)
    {
        return '这是One模块，显示在Top<br />';
    }

    public function hookDisplayHead($params)
    {
        return '这是One模块，显示在Head<br />';
    }

    public function hookDisplayFoot($params)
    {
        return '这是One模块，显示在Foot<br />';
    }
}
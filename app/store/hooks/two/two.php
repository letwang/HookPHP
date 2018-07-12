<?php
class Two
{
    public function hookDisplayTop($params)
    {
        return '这是Two模块，显示在Top<br />';
    }

    public function hookDisplayHead($params)
    {
        return '这是Two模块，显示在Head<br />';
    }

    public function hookDisplayFoot($params)
    {
        return '这是Two模块，显示在Foot<br />';
    }
}
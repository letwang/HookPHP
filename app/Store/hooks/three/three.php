<?php
class Three
{
    public function hookDisplayTop($args)
    {
        return '这是Three模块，显示在Top<br />';
    }

    public function hookDisplayHead($args)
    {
        return '这是Three模块，显示在Head<br />';
    }

    public function hookDisplayFoot($args)
    {
        return '这是Three模块，显示在Foot<br />';
    }
}
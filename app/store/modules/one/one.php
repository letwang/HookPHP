<?php
class One
{
    public function hookDisplayTop($params)
    {
        return 'One:hookDisplayTop';
    }

    public function hookDisplayHead($params)
    {
        return 'One:hookDisplayHead';
    }

    public function hookDisplayFoot($params)
    {
        return 'One:hookDisplayFoot';
    }
}
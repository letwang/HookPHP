<?php
class Three
{
    public function hookDisplayTop($params)
    {
        return 'Three:hookDisplayTop';
    }

    public function hookDisplayHead($params)
    {
        return 'Three:hookDisplayHead';
    }

    public function hookDisplayFoot($params)
    {
        return 'Three:hookDisplayFoot';
    }
}
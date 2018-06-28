<?php
class Two
{
    public function hookDisplayTop($params)
    {
        return 'Two:hookDisplayTop';
    }

    public function hookDisplayHead($params)
    {
        return 'Two:hookDisplayHead';
    }

    public function hookDisplayFoot($params)
    {
        return 'Two:hookDisplayFoot';
    }
}
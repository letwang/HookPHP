<?php
class User_UserController extends Base\ViewController
{
    protected function renderList(): void
    {
        $this->ignore += ['pass' => true];
        parent::renderList();
    }
}
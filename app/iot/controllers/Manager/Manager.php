<?php
class Manager_ManagerController extends Base\ViewController
{
    protected function renderList(): void
    {
        $this->ignore += ['pass' => true];
        parent::renderList();
    }
}
<?php
declare(strict_types=1);

class Manager_ManagerController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'app_id'],
        ['data' => 'user'],
        ['data' => 'email'],
        ['data' => 'phone'],
        ['data' => 'firstname'],
        ['data' => 'lastname'],
        ['data' => 'status'],
        ['data' => 'date_add'],
        ['data' => 'date_upd'],
    ];
}
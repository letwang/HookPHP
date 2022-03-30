<?php
declare(strict_types=1);

use Manager\ManagerModel;
use Rbac\RoleModel;

class Rbac_Manager_RoleController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'manager_id'],
        ['data' => 'role_id'],
        ['data' => 'status'],
        ['data' => 'date_add'],
        ['data' => 'date_upd'],
    ];
}
<?php
declare(strict_types=1);

use Rbac\{GroupModel, RoleModel};

class Rbac_Group_RoleController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'group_id'],
        ['data' => 'role_id'],
        ['data' => 'status'],
        ['data' => 'date_add'],
        ['data' => 'date_upd'],
    ];
}
<?php
declare(strict_types=1);

use Rbac\GroupModel;
use Manager\ManagerModel;

class Rbac_Group_ManagerController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'group_id'],
        ['data' => 'manager_id'],
        ['data' => 'status'],
        ['data' => 'date_add'],
        ['data' => 'date_upd'],
    ];
}
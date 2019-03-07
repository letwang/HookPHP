<?php
namespace Acl;

class IndexModel extends \AbstractModel
{
    public static $table = 'hp_acl_group_resource';

    public function __construct(int $id = null)
    {
        parent::__construct($id);
    }
}
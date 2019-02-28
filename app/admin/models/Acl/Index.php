<?php
namespace Acl;

class IndexModel extends \AbstractModel
{
    public static $table = 'hp_acl_group_resource';

    public function __construct(int $id = null, int $langId = null)
    {
        parent::__construct($id, $langId);
    }
}
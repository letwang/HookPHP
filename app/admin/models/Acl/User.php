<?php
namespace Acl;

class UserModel extends \AbstractModel
{
    public static $table = 'hp_acl_user_role';

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }
}
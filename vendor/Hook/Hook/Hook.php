<?php
namespace Hook\Hook;
use Hook\Db\PdoConnect;

class Hook
{
    public function __construct()
    {
        //
    }

    public function __destruct()
    {
        //
    }

    public static function run($name, $args = null)
    {
        $html = '';
        $hookModule = PdoConnect::getInstance()->fetchAll(
            \Hook\Sql\Module::SQL_GET_MODULES_FOR_HOOK,
            [$name]
        );
        foreach ($hookModule as $data) {
            $html .= call_user_func(array(Module::getInstance($data['module'])->module, 'hook'.$data['hook']), $args);
        }
        return $html;
    }
}
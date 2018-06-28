<?php
namespace Let\Hook;
use Let\Db\Db;

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
        $hookModule = Db::getInstance()->fetchAll(
            'SELECT a.`key` as hook,c.`key` as module FROM `hp_hook` a LEFT JOIN`hp_hook_module` b ON a.`id`=b.`hook_id` LEFT JOIN `hp_module` c ON b.`module_id`=c.`id` WHERE a.`key`=? AND c.`status`=1 ORDER BY b.`position` DESC ',
            [$name]
        );
        foreach ($hookModule as $data) {
            $html .= call_user_func(array(self::getModuleInstance($data['module']), 'hook'.$data['hook']), $args);
        }
        return $html;
    }

    public static function getModuleInstance($module)
    {
        static $instance = null;
        if (isset($instance[$module])) {
            return $instance[$module];
        }
        require APP_PATH.'/modules/'.$module.'/'.$module.'.php';
        return $instance[$module] = new $module;
    }
}
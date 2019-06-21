<?php
use Yaf\{Dispatcher, Bootstrap_Abstract};
use Hook\Db\{RedisConnect, YacConnect};


class Bootstrap extends Bootstrap_Abstract
{
    public function _init(Dispatcher $dispatcher)
    {
        session_start();

        $dispatcher->registerPlugin(new HookPlugin());

        //Loader::getInstance()->registerLocalNamespace('Hook');

        defined('APP_ID') || define('APP_ID', AppModel::getInstance()->getDefaultId());
        foreach (ConfigModel::getInstance()->getDefined() as $key => $value) {
            defined($key) || define($key, $value);
        }
        defined('APP_LANG_ID') || define('APP_LANG_ID', LangModel::getInstance()->getDefaultId());

        if (RedisConnect::getInstance()->handle->exists(Yaconf::get('const')['yac']['expired_key'])) {
            foreach (RedisConnect::getInstance()->handle->sMembers(Yaconf::get('const')['yac']['expired_key']) as $table) {
                foreach (Yaconf::get('const')['table'] as $key) {
                    YacConnect::getInstance()->handle->delete(sprintf($key, $table));
                }
            }
            RedisConnect::getInstance()->handle->del(Yaconf::get('const')['yac']['expired_key']);
        }
    }
}

function l(string $key)
{
    return Yaconf::get('admin_lang_'.LangModel::getInstance()->getDefaultName().'.'.$key, $key);
}
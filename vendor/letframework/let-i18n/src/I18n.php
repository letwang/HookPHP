<?php
namespace Let\I18n;

use \Let\Cache\Cache;

class I18n
{

    public $redis;

    public $app;

    public $lang;

    public function __construct(string $lang = 'zh_CN')
    {
        $this->redis = Cache::getInstance()->redis;
        $this->app = APP_CONFIG['application']['name'];
        $this->lang = $lang;
        if (! $this->redis->keys($this->key() . '*')) {
            foreach (require APP_PATH . '/lang/' . $this->lang . '.php' as $module => $lang) {
                $key = $this->key($module);
                
                $hash = [];
                foreach ($lang as $field => $value) {
                    $hash[$field] = strtr($field, $value);
                }
                
                $this->redis->hMSet($key, $hash);
            }
        }
    }

    public function key(string $module = ''): string
    {
        return $this->app . ':lang:' . $this->lang . ':' . $module;
    }

    public function get(string $module, string $field, array $value = []): string
    {        
        if ($this->exists($module, $field)) {
            return $this->redis->hGet($this->key($module), $field);
        }
        
        $this->set($module, $field, $value);
        return strtr($field, $value);
    }

    public function getAll(string $module): array
    {
        return $this->redis->hGetAll($this->key($module));
    }

    public function set(string $module, string $field, array $value): int
    {
        return $this->redis->hSet($this->key($module), $field, strtr($field, $value));
    }

    public function exists(string $module, string $field): bool
    {
        return $this->redis->hExists($this->key($module), $field);
    }

    public function del(string $module, string $field): int
    {
        return $this->redis->hDel($this->key($module), $field);
    }
}
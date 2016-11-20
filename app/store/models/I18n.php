<?php

class I18nModel
{

    public $redis;

    public $app;

    public $lang;

    public function __construct($redis, $app, $lang)
    {
        $this->redis = $redis;
        $this->app = $app;
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

    public function key($module = '')
    {
        return $this->app . ':lang:' . $this->lang . ':' . $module;
    }

    public function get($module, $field, array $value = [])
    {
        $key = $this->key($module);
        
        if ($this->exists($key, $field)) {
            return $this->redis->hGet($key, $field);
        }
        
        $this->set($key, $field, $value);
        return strtr($field, $value);
    }

    public function getAll($module)
    {
        return $this->redis->hGetAll($this->key($module));
    }

    public function set($key, $field, array $value)
    {
        return $this->redis->hSet($key, $field, strtr($field, $value));
    }

    public function exists($key, $field)
    {
        return $this->redis->hexists($key, $field);
    }

    public function del($key, $field)
    {
        return $this->redis->hDel($key, $field);
    }
}
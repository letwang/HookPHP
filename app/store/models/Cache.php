<?php

class CacheModel
{

    public $redis;

    public $app;

    public function __construct($redis, $app)
    {
        $this->redis = $redis;
        $this->app = $app;
    }
}

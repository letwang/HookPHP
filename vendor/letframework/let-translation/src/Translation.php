<?php
namespace Let\Translation;

abstract class Translation
{

    public static function factory($adapter, $crawlers, $db, $table)
    {
        $adapter = '\Let\Translation\\' . ucfirst($adapter) . 'Adapter';
        return new $adapter($crawlers, $db, $table);
    }
}
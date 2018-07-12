<?php
namespace Hook\Translation;

abstract class Translation
{

    public static function factory($adapter, $crawlers, $db, $table)
    {
        $adapter = '\Hook\Translation\\' . ucfirst($adapter) . 'Adapter';
        return new $adapter($crawlers, $db, $table);
    }
}
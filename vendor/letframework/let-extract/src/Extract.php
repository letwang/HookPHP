<?php
namespace Let\Extract;

abstract class Extract
{

    public static function factory($file)
    {
        $adapter = self::getAadapterClass($file);
        
        if ($adapter) {
            $adapter = '\Let\Extract\\' . ucfirst($adapter) . 'Adapter';
            return new $adapter($file);
        }
        
        return false;
    }

    public static function getAadapterClass($file)
    {
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        
        switch ($extension) {
            case 'zip':
            case 'cbz':
            case 'jar':
                return 'zip';
                break;
            case 'rar':
                return 'rar';
                break;
        }
        
        return false;
    }
}

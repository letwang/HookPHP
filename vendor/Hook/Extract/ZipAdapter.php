<?php
namespace Hook\Extract;

use Hook\Extract\AbstractAdapter;
use Hook\Extract\ExtractInterface;

class ZipAdapter extends AbstractAdapter implements ExtractInterface
{

    public object $handle = null;

    public function __construct($file)
    {
        $this->handle = new \ZipArchive();
        
        if ($this->handle->open($file) !== true) {
            throw new \Exception('Error reading zip-archive:' . $file);
        }
    }

    public function __destruct()
    {
        $this->handle->close();
    }

    public function getList()
    {
        return parent::_getList($this->handle->numFiles);
    }

    public function getFileContent($index)
    {
        return $this->handle->getFromIndex($index);
    }

    public function getFileName($index)
    {
        return $this->mbConvertEncoding($this->handle->getNameIndex($index));
    }

    public function getFileStat($index)
    {
        return $this->handle->statIndex($index);
    }

    public function getFileExtension($index)
    {
        return pathinfo($this->handle->statIndex($index)['name'], PATHINFO_EXTENSION);
    }

    public function extractTo($dir, $index)
    {
        return parent::_extractTo($dir, $index);
    }
}
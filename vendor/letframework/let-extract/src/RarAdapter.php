<?php
namespace Let\Extract;

use Let\Extract\AbstractAdapter;
use Let\Extract\ExtractInterface;

class RarAdapter extends AbstractAdapter implements ExtractInterface
{

    public $handle = null;

    public function __construct($file)
    {
        $this->handle = \RarArchive::open($file);
        $this->handle->entries = $this->handle->getEntries();
        
        if ($this->handle === false || $this->handle->entries === false) {
            throw new \Exception('Error reading rar-archive:' . $file);
        }
    }

    public function __destruct()
    {
        $this->handle->close();
    }

    public function getList()
    {
        return parent::_getList(count($this->handle->entries));
    }

    public function getFileContent($index)
    {
        return stream_get_contents($this->handle->entries[$index]->getStream());
    }

    public function getFileName($index)
    {
        return $this->mbConvertEncoding($this->handle->entries[$index]->getName());
    }

    public function getFileStat($index)
    {
        return array(
            'name' => $this->getFileName($index),
            'index' => $index,
            'crc' => $this->handle->entries[$index]->getCrc(),
            'size' => $this->handle->entries[$index]->getUnpackedSize(),
            'mtime' => strtotime($this->handle->entries[$index]->getFileTime()),
            'comp_size' => $this->handle->entries[$index]->getPackedSize(),
            'comp_method' => $this->handle->entries[$index]->getMethod()
        );
    }

    public function getFileExtension($index)
    {
        return pathinfo($this->getFileName($index), PATHINFO_EXTENSION);
    }

    public function extractTo($dir, $index)
    {
        return parent::_extractTo($dir, $index);
    }
}
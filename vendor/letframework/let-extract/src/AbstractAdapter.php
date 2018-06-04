<?php
namespace Let\Extract;

use Let\Extract\ExtractInterface;

abstract class AbstractAdapter implements ExtractInterface
{

    public function __construct()
    {
        //
    }

    public function mbDetectEncoding($str)
    {
        $encodingList = mb_detect_order();
        $encodingList[] = 'GBK';
        
        return mb_detect_encoding($str, $encodingList, true);
    }

    public function mbConvertEncoding($str, $toEncoding = 'UTF-8')
    {
        $fromEncoding = $this->mbDetectEncoding($str);
        
        if ($fromEncoding !== false) {
            return mb_convert_encoding($str, $toEncoding, $fromEncoding);
        }
        
        return $str;
    }

    protected function _extractTo($dir, $index)
    {
        $file = $dir . $this->getFileName($index);
        
        if (is_file($file)) {
            return $file;
        }
        
        $dir = pathinfo($file, PATHINFO_DIRNAME);
        if (! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        
        return file_put_contents($file, $this->getFileContent($index), LOCK_EX) !== false ? $file : false;
    }

    protected function _getList($numFiles)
    {
        $result = [];
        
        for ($index = 0; $index < $numFiles; $index ++) {
            $path = $this->getFileName($index);
            
            $pathArray = explode('/', $path);
            foreach ($pathArray as $k => $v) {
                if ($k === 0 && ! isset($result[''][$v])) {
                    $result[''][$v] = $this->_parse($path, $v, $index);
                }
                
                $nextLevel = $k + 1;
                if (isset($pathArray[$nextLevel])) {
                    $folder = join('/', array_slice($pathArray, 0, $nextLevel));
                    $nextV = $pathArray[$nextLevel];
                    
                    if (! isset($result[$folder][$nextV]) && $nextV !== '') {
                        $result[$folder][$nextV] = $this->_parse($path, $nextV, $index, $folder . '/');
                    }
                }
            }
        }
        
        return $result;
    }

    private function _parse($path, $part, $index, $parent = '')
    {
        if (strpos($path, $part . '/') !== false) {
            return [
                'index' => 'dir',
                'path' => $parent . $part
            ];
        }
        
        return [
            'index' => $index,
            'path' => $parent . $part,
            'extension' => pathinfo($path, PATHINFO_EXTENSION)
        ];
    }
}
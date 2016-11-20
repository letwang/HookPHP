<?php
namespace Let\File;

class File
{

    public static function write($file, $data)
    {
        $fp = fopen($file, 'cb');
        
        if (! $fp) {
            return false;
        }
        
        if (! flock($fp, LOCK_EX | LOCK_NB)) {
            fclose($fp);
            return false;
        }
        
        if (fwrite($fp, $data) === false) {
            flock($fp, LOCK_UN);
            fclose($fp);
            return false;
        }
        
        if (! ftruncate($fp, mb_strlen($data))) {
            flock($fp, LOCK_UN);
            fclose($fp);
            return false;
        }
        flock($fp, LOCK_UN);
        fclose($fp);
        return true;
    }

    public static function read($file)
    {
        $fp = fopen($file, 'rb');
        if (! $fp) {
            return false;
        }
        if (! flock($fp, LOCK_SH | LOCK_NB)) {
            fclose($fp);
            return false;
        }
        $data = stream_get_contents($fp);
        if ($data === false) {
            flock($fp, LOCK_UN);
            fclose($fp);
            return false;
        }
        flock($fp, LOCK_UN);
        fclose($fp);
        return $data;
    }

    public static function down($file)
    {
        ob_start();
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        return readfile($file);
    }

    public static function cut($file, $perLine = 100, $firstLineAsTitle = false, $delimiter = ',', $enclosure = '"', $escape = '\\')
    {
        $fileAttr = pathinfo($file);
        $handle = fopen($file, 'rb');
        if ($firstLineAsTitle) {
            $title = fgetcsv($handle, 0, $delimiter, $enclosure, $escape);
        }
        for ($i = 0; $row = fgetcsv($handle, 0, $delimiter, $enclosure, $escape); $i ++) {
            if ($i % $perLine == 0) {
                $fp = fopen($fileAttr['filename'] . '_' . $i / $perLine . '.' . $fileAttr['extension'], 'cb');
                if ($firstLineAsTitle) {
                    fputcsv($fp, $title);
                }
            }
            fputcsv($fp, $row);
        }
        fclose($handle);
    }

    public static function createDir($path, $rights = 0777)
    {
        if (is_dir($path))
            return true;
        $result = @mkdir($path, $rights, true);
        @chmod($path, $rights);
        return $result;
    }

    public static function findFolder($dir)
    {
        $directory = glob($dir . '/*', GLOB_ONLYDIR | GLOB_NOSORT);
        for ($i = 0; $i < count($directory); $i ++) {
            $add = glob($directory[$i] . '/*', GLOB_ONLYDIR | GLOB_NOSORT);
            if (count($add) > 0) {
                $directory = array_merge($directory, $add);
            }
        }
        return array_merge([
            $dir
        ], $directory);
    }

    public static function findFiles($dir, $extensions = '*.*')
    {
        $directory = self::findFolder($dir);
        $files = [];
        foreach ($directory as $v) {
            $add = glob($v . '/{' . $extensions . '}', GLOB_BRACE | GLOB_NOSORT);
            if (count($add) > 0) {
                $files = array_merge($files, $add);
            }
        }
        return $files;
    }
}
<?php
namespace Hook\Batch;

use Hook\Db\PdoConnect;

class Process
{
    public static function read(array $param = [], int $style = \PDO::FETCH_ASSOC, $argument = null, array $args = [])
    {
        if (! isset($param['sql']) || ! isset($param['placeholder']) || ! is_array($param['placeholder'])) {
            return false;
        }
        
        $offset = 0;
        $rows = isset($param['rows']) ? (int) $param['rows'] : 30;
        
        $stmt = PdoConnect::getInstance()->query(sprintf($param['sql'], $offset * $rows, $rows), $param['placeholder']);
        
        $num = func_num_args();
        while ($stmt->rowCount() > 0) {
            if ($num <= 2) {
                yield $stmt->fetchAll($style);
            } else {
                yield $stmt->fetchAll($style, $argument, $args);
            }
            
            $offset ++;
            $stmt = PdoConnect::getInstance()->query(sprintf($param['sql'], $offset * $rows, $rows), $param['placeholder']);
        }
    }

    public static function exportToCsv($file, array $fields, array $param)
    {
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        
        $handle = fopen('php://output', 'cb');
        
        fwrite($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF8 BOM
        
        fputcsv($handle, $fields);
        
        if (isset($param['sql'])) {
            self::read(
                $param,
                \PDO::FETCH_FUNC,
                function () use (&$handle) {
                    fputcsv($handle, func_get_args());
                }
            );
        } else {
            foreach ($param as $param) {
                fputcsv($handle, $param);
            }
        }
        
        fclose($handle);
    }

    public static function skipFileBOM(&$handle)
    {
        rewind($handle);
        
        $offset = 0;
        
        switch (1) {
            case fgets($handle, 4) == "\xEF\xBB\xBF": // UTF-8
                $offset = 3;
                fseek($handle, $offset);
                break;
            case fgets($handle, 3) == "\xFF\xFE": // UTF-16LE
            case fgets($handle, 3) == "\xFE\xFF": // UTF-16BE
                $offset = 2;
                fseek($handle, $offset);
                break;
            case fgets($handle, 5) == "\xFF\xFE\x00\x00": // UTF-32LE
            case fgets($handle, 5) == "\x00\x00\xFE\xFF": // UTF-32BE
                $offset = 4;
                fseek($handle, $offset);
                break;
        }
        
        if ($offset === 0) {
            fseek($handle, $offset);
        }
        
        return $offset;
    }

    public static function convertFileEncoding(&$handle)
    {
        $offset = self::skipFileBOM($handle);
        
        $encoding = mb_detect_encoding(fgets($handle, 4), 'UTF-8', true) ?: 'GBK';
        
        fseek($handle, $offset);
        
        switch ($encoding) {
            case 'GBK':
                stream_filter_append($handle, "convert.iconv.gbk/utf-8");
                break;
        }
        
        return $encoding;
    }

    public static function template1(array $keys, array $rows, $title)
    {
        $str = '<table width="100%" border="1" cellpadding="1" cellspacing="1">
            <caption><h2>' . $title . '</h2></caption><thead>';
        $str .= '<tr>';
        foreach ($keys as $key) {
            $str .= '<td>' . $key . '</td>';
        }
        $str .= '</tr></thead><tbody>';
        foreach ($rows as $row) {
            $str .= '<tr>';
            foreach ($keys as $key) {
                $str .= '<td>' . $row[$key] . '</td>';
            }
            $str .= '</tr>';
        }
        $str .= '</tbody></table>';
        
        return $str;
    }

    public static function template2(array $rows, $title)
    {
        $str = '<h2>' . $title . '</h2><pre><div><ol>';
        foreach (explode(PHP_EOL, var_export($rows, true)) as $v) {
            $str .= '<li>' . $v . '</li>';
        }
        $str .= '</ol></div></pre>' . PHP_EOL . PHP_EOL . PHP_EOL;
        
        return $str;
    }
}
<?php
namespace Let\Batch;

use Let\Db\Db;

class Process
{

    /**
     * 根据SQL读取大数据；充分运用PDO:fetchAll后2个参数，一键实现复杂功能
     *
     * @param array $param
     *            数据源：带分页的SQL和占位符传递的值
     * @param int $style
     *            PDO:fetch_style
     * @param mixed $argument
     *            PDO:fetch_argument
     * @param array $args
     *            PDO:ctor_args
     * @return array
     */
    public static function read(array $param = [], $style = \PDO::FETCH_ASSOC, $argument = null, array $args = [])
    {
        if (! isset($param['sql']) || ! isset($param['placeholder']) || ! is_array($param['placeholder'])) {
            return false;
        }
        
        $offset = 0;
        $rows = isset($param['rows']) ? (int) $param['rows'] : 30;
        
        $stmt = Db::getConnection()->query(sprintf($param['sql'], $offset * $rows, $rows), $param['placeholder']);
        
        $data = [];
        $num = func_num_args();
        while ($stmt->rowCount() > 0) {
            if ($num <= 2) {
                $data[] = $stmt->fetchAll($style);
            } else {
                $data[] = $stmt->fetchAll($style, $argument, $args);
            }
            
            $offset ++;
            $stmt = Db::getConnection()->query(sprintf($param['sql'], $offset * $rows, $rows), $param['placeholder']);
            
            usleep(100);
        }
        
        return $data;
    }

    /**
     * 根据数据源智能读取大数据并下载为CSV文件
     *
     * @param string $file
     *            需要下载的文件名称
     * @param array $fields
     *            CSV文件所要显示的列名称
     * @param array $param
     *            数据源：PHP二维数组｜带分页的SQL和占位符传递的值
     * @return 下载CSV文件
     */
    public static function exportToCsv($file, array $fields, array $param)
    {
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        
        $handle = fopen('php://output', 'cb');
        
        fwrite($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF8 BOM
        
        fputcsv($handle, $fields);
        
        if (isset($param['sql'])) {
            self::read($param, \PDO::FETCH_FUNC, function () use (&$handle) {
                fputcsv($handle, func_get_args());
            });
        } else {
            foreach ($param as $param) {
                fputcsv($handle, $param);
            }
        }
        
        fclose($handle);
    }

    /**
     * 智能去除文件BOM
     *
     * @param
     *            resource &$handle 文件句柄
     * @return 当前文件所在的指针位置
     */
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

    /**
     * 智能处理文件编码导致的乱码问题
     *
     * @param
     *            resource &$handle 文件句柄
     * @return 当前文件编码的类型
     */
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

    /**
     * 表格模板
     *
     * @param array $keys            
     * @param array $rows            
     * @param string $title            
     * @return string
     */
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

    /**
     * Code模板
     *
     * @param array $rows            
     * @param string $title            
     * @return string
     */
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
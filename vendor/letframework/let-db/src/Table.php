<?php
namespace Let\Db;

use Redis, PDO;
use \Let\Validate\Validate, \Let\Cache\Cache;

class Table
{

    public $table;
    public $operator = ['>' => '>', '>=' => '>=', '<' => '<', '<=' => '<=', '!=' => '!=', 'LIKE' => 'LIKE', 'NOT LIKE' => 'NOT LIKE', 'IN' => 'IN', 'NOT IN' => 'NOT IN'];
    public $selectExpr = ['DISTINCT', 'DISTINCTROW', 'SQL_CACHE', 'SQL_NO_CACHE', 'SQL_CALC_FOUND_ROWS'];

    public function __construct(string $table)
    {
        $this->table = $table;
        $redis = Cache::getInstance()->redis;
        $redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
        $redis->setOption(Redis::OPT_PREFIX, APP_CONFIG['application']['name'] . ':table:');
        if ($redis->exists($this->table)) {
            $this->data = $redis->hGetAll($this->table);
        } else {
            $data = Db::getInstance()->fetchAll('DESC ' . $this->table);
            $this->data = array_combine(array_column($data, 'Field'), $data);
            $redis->hMset($this->table, $this->data);
        }
    }

    public function read(array $param = [])
    {
        $sql = 'SELECT ';
        $param += ['selectExpr' => null, 'COLUMN' => ['id'], 'WHERE' => null, 'GROUP' => null, 'ORDER' => null, 'OFFSET' => null, 'LIMIT' => null, 'CALLBACK' => 'fetchAll', 'TYPE' => PDO::FETCH_ASSOC];

        //查询表达式
        if (is_array($param['selectExpr']) && !empty($param['selectExpr'])) {
            $sql .= join(' ', array_intersect($param['selectExpr'], $this->selectExpr));
        }

        //查询列
        if (is_array($param['COLUMN']) && $param['COLUMN'][0] === '*' || $param['COLUMN'][0] === 'COUNT(*)') {
            $sql .= ' '.$param['COLUMN'][0];
        } else {
            $sql .= ' `'.join('`,`', (array) $param['COLUMN']).'`';
        }
        $sql .= ' FROM `'.$this->table.'`';

        //筛选
        $where = $parameters = [];
        if (is_array($param['WHERE']) && !empty($param['WHERE'])) {
            foreach ($param['WHERE'] as $field => $data) {
                if (is_array($data)) {
                    foreach ($data as $operator => $value) {
                        $where[] = '`'.$field.'` '.$this->operator[$operator].' ('.implode(',', array_fill(0, count($value), '?')).')';
                        $parameters = array_merge($parameters, $value);
                    }
                } else {
                    $where[] = '`'.$field.'`=?';
                    $parameters[] = $data;
                }
            }
            $sql .= ' WHERE '.join(' AND ', $where);
        }

        //分组
        if (is_array($param['GROUP']) && !empty($param['GROUP'])) {
            $group = [];
            foreach ($param['GROUP'] as $field => $expr) {
                $group[] = '`'.$field.'` '.Validate::order($expr);
            }
            $sql .= ' GROUP BY '.join(',', $group);
        }

        //排序
        if (is_array($param['ORDER']) && !empty($param['ORDER'])) {
            $order = [];
            foreach ($param['ORDER'] as $field => $expr) {
                $order[] = '`'.$field.'` '.Validate::order($expr);
            }
            $sql .= ' ORDER BY '.join(',', $order);
        }

        //分页
        if ($param['OFFSET'] >= 0 && $param['LIMIT'] > 0 ) {
            $sql .= ' LIMIT '.(int) $param['OFFSET'].', '.(int) $param['LIMIT'];
        }

        //sql字段名注入检查
        preg_match_all('/`(\w+)`/', $sql, $matches);
        $whiteField = $this->data + [$this->table => ['Field' => $this->table]];
        foreach ($matches[1] as $field) {
            if (!isset($whiteField[$field])) {
                throw new \Exception('db hack~');
            }
        }

        //var_dump($sql, $parameters);
        //动态调用DB方法
        return Db::getInstance()->{$param['CALLBACK']}($sql, $parameters, (int) $param['TYPE']);
    }

    public function desc():array
    {
        return $this->data;
    }

    public function exist(string $column):bool
    {
        return isset($this->data[$column]);
    }

    public function validate(string $column, $needle = null):array
    {
        $type = $this->data[$column]['Type'];
        $unsigned = strpos($type, 'unsigned');
        $data = ['min' => null, 'max' => null];
        switch (1) {
            case strpos($type, 'tinyint') === 0:
                $data = ['min' => -128, 'max' => 127];
                if ($unsigned) {
                    $data = ['min' => 0, 'max' => 255];
                }
                break;
            case strpos($type, 'smallint') === 0:
                $data = ['min' => -32768, 'max' => 32767];
                if ($unsigned) {
                    $data = ['min' => 0, 'max' => 65535];
                }
                break;
            case strpos($type, 'mediumint') === 0:
                $data = ['min' => -8388608, 'max' => 8388607];
                if ($unsigned) {
                    $data = ['min' => 0, 'max' => 16777215];
                }
                break;
            case strpos($type, 'int') === 0:
                $data = ['min' => -2147483648, 'max' => 2147483647];
                if ($unsigned) {
                    $data = ['min' => 0, 'max' => 4294967295];
                }
                break;
            case strpos($type, 'bigint') === 0:
                $data = ['min' => -9223372036854775808, 'max' => 9223372036854775807];
                if ($unsigned) {
                    $data = ['min' => 0, 'max' => 18446744073709551615];
                }
                break;
            case strpos($type, 'enum') === 0:
                $type = array_flip(
                    preg_replace(
                        ['/enum\(/', '/\)/', '/\'/'],
                        '',
                        explode("','", $type)
                    )
                );
                $data = ['min' => 0, 'max' => count($type)];
                if ($needle !== null) {
                    $data['validate'] = isset($type[$needle]);
                }
                return $data;
                break;
            case strpos($type, 'char') !== false:
                $needle = mb_strlen($needle);
                $data = ['min' => 0, 'max' => (int) preg_replace(['/var/', '/char/', '/\(/', '/\)/'], '', $type), 'length' => $needle];
                break;
            case strpos($type, 'binary') !== false:
                $needle = strlen($needle);
                $data = ['min' => 0, 'max' => (int) preg_replace(['/var/', '/binary/', '/\(/', '/\)/'], '', $type), 'length' => $needle];
                break;
            case strpos($type, 'tinytext') === 0 || strpos($type, 'tinyblob') === 0:
                $needle = strlen($needle);
                $data = ['min' => 0, 'max' => 255, 'length' => $needle];//255B
                break;
            case strpos($type, 'text') === 0 || strpos($type, 'blob') === 0:
                $needle = strlen($needle);
                $data = ['min' => 0, 'max' => 65535, 'length' => $needle];//64K
                break;
            case strpos($type, 'mediumtext') === 0 || strpos($type, 'mediumblob') === 0:
                $needle = strlen($needle);
                $data = ['min' => 0, 'max' => 16777215, 'length' => $needle];//16M
                break;
            case strpos($type, 'longtext') === 0 || strpos($type, 'longblob') === 0:
                $needle = strlen($needle);
                $data = ['min' => 0, 'max' => 4294967295, 'length' => $needle];//4G
                break;
        }
        
        if ($needle !== null) {
            $data['validate'] = $needle >= $data['min'] && $needle <= $data['max'];
        }
        
        return $data;
    }

    public function default(string $column):?string
    {
        return $this->data[$column]['Default'];
    }
}
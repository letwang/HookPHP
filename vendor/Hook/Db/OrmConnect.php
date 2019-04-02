<?php
namespace Hook\Db;

use Hook\Cache\Cache;
use Yaf\Registry;

class OrmConnect extends Cache
{
    public $table = '';

    private $statement = '';
    private $parameter = [];

    private $operator = ['=' => '=', '!=' => '!=', '>' => '>', '>=' => '>=', '<' => '<', '<=' => '<=', 'LIKE' => 'LIKE', 'NOT LIKE' => 'NOT LIKE', 'IN' => 'IN', 'NOT IN' => 'NOT IN'];
    private $expression = ['DISTINCT', 'DISTINCTROW', 'SQL_CALC_FOUND_ROWS'];

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function __destruct()
    {
        $this->statement = '';
        $this->parameter = [];
    }

    public function desc(): array
    {
        return APP_TABLE[$this->table];
    }

    public function exist(string $column = null): bool
    {
        return $column ? isset(APP_TABLE[$this->table][$column]) : isset(APP_TABLE[$this->table]);
    }

    public function select(array $column = ['id'], array $expression = []): self
    {
        if ($expression) {
            $this->statement .= join(' ', array_intersect($expression, $this->expression));
        }
        if ($column) {
            $this->statement .= '`'.join('`,`', $column).'`';
        } else {
            $this->statement .= '1';
        }
        $this->statement = 'SELECT '.$this->statement.' FROM `'.$this->table.'` ';
        return $this;
    }

    public function where(array $condition, string $relationOut = 'AND', string $relationIn = 'AND'): self
    {
        $statement = '';
        $relationOut = $relationOut === 'AND' ? ' AND ' : ' OR ';
        $relationIn = $relationIn === 'AND' ? ' AND ' : ' OR ';
        foreach ($condition as $column => $value) {
            foreach (is_array($value) ? $value : ['=' => $value] as $operator => $value) {
                $statement .= '`'.$column.'`'.$this->operator[$operator];
                if (is_array($value)) {
                    $statement .= '('.implode(',', array_fill(0, count($value), '?')).')';
                    $this->parameter = array_merge($this->parameter, $value);
                } else {
                    $statement .= '?';
                    $this->parameter[] = $value;
                }
            }
            $statement .= $relationIn;
        }
        $this->statement .= (strpos($this->statement, 'WHERE') === false ? 'WHERE ' : $relationOut).'('.rtrim($statement, $relationIn).')';
        return $this;
    }

    public function group(array $group): self
    {
        $this->statement .= ' GROUP BY';
        foreach ($group as $column => $value) {
            $this->statement .= ' `'.$column.'` '.($value === 'DESC' ? 'DESC' : 'ASC').',';
        }
        $this->statement = substr($this->statement, 0, -1);

        return $this;
    }

    public function order(array $order): self
    {
        $this->statement .= ' ORDER BY';
        foreach ($order as $column => $value) {
            $this->statement .= ' `'.$column.'` '.($value === 'DESC' ? 'DESC' : 'ASC').',';
        }
        $this->statement = substr($this->statement, 0, -1);

        return $this;
    }

    public function limit(int $count = 30, int $offset = null): self
    {
        $this->statement .= ' LIMIT '.($offset === null ? '' : $offset.',').$count;
        return $this;
    }

    public function fetchAll(int $type = \PDO::FETCH_ASSOC): array
    {
        list($statement, $parameter) = $this->checkAndClear();
        return PdoConnect::getInstance()->fetchAll($statement, $parameter, $type);
    }

    public function fetch(int $type = \PDO::FETCH_ASSOC)
    {
        list($statement, $parameter) = $this->checkAndClear();
        return PdoConnect::getInstance()->fetch($statement, $parameter, $type);
    }

    public function fetchColumn(int $column = 0)
    {
        list($statement, $parameter) = $this->checkAndClear();
        return PdoConnect::getInstance()->fetchColumn($statement, $parameter, $column);
    }

    public function count(): int
    {
        $this->statement = 'SELECT FOUND_ROWS()';
        $this->parameter = [];
        return $this->fetch()['FOUND_ROWS()'];
    }

    public function insert(array $parameter): array
    {
        $this->statement = 'INSERT INTO `'.$this->table.'`(`'.join('`,`', array_keys($parameter)).'`)VALUES(:'.join(',:', array_keys($parameter)).')';
        $this->parameter = $parameter;
        list($statement, $parameter) = $this->checkAndClear();
        return PdoConnect::getInstance()->insert($statement, $parameter);
    }

    public function update(array $assignment): int
    {
        $statement = '';
        $parameter = [];
        foreach ($assignment as $column => $value) {
            $statement .= '`'.$column.'`=?,';
            $parameter[] = $value;
        }

        $this->statement = 'UPDATE `'.$this->table.'` SET '.substr($statement, 0, -1).$this->statement;
        $this->parameter = array_merge($parameter, $this->parameter);
        list($statement, $parameter) = $this->checkAndClear();
        return PdoConnect::getInstance()->update($statement, $parameter);
    }

    public function delete(): int
    {
        $this->statement = 'DELETE FROM `'.$this->table.'` '.$this->statement;
        list($statement, $parameter) = $this->checkAndClear();
        return PdoConnect::getInstance()->delete($statement, $parameter);
    }

    public function validate(string $type): array
    {
        $unsigned = strpos($type, 'unsigned');
        $data = ['min' => null, 'max' => null];
        switch (1) {
            case strpos($type, 'tinyint') === 0:
                $data = ['min' => -128, 'max' => 127];
                if ($unsigned) {
                    $data = ['min' => 0, 'max' => strpos($type, '1') > 0 ? 1 : 255];
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
                return $data;
                break;
            case strpos($type, 'char') !== false:
                $func = function ($value) {return mb_strlen($value);};
                $data = ['min' => 0, 'max' => (int) preg_replace(['/var/', '/char/', '/\(/', '/\)/'], '', $type)];
                break;
            case strpos($type, 'binary') !== false:
                $data = ['min' => 0, 'max' => (int) preg_replace(['/var/', '/binary/', '/\(/', '/\)/'], '', $type)];
                break;
            case strpos($type, 'tinytext') === 0 || strpos($type, 'tinyblob') === 0:
                $data = ['min' => 0, 'max' => 255];//255B
                break;
            case strpos($type, 'text') === 0 || strpos($type, 'blob') === 0:
                $data = ['min' => 0, 'max' => 65535];//64K
                break;
            case strpos($type, 'mediumtext') === 0 || strpos($type, 'mediumblob') === 0:
                $data = ['min' => 0, 'max' => 16777215];//16M
                break;
            case strpos($type, 'longtext') === 0 || strpos($type, 'longblob') === 0:
                $data = ['min' => 0, 'max' => 4294967295];//4G
                break;
        }
        return $data;
    }

    public function synData(): bool
    {
        $redis = RedisConnect::getInstance()->redis;
        $key = 'table:'.$this->table;
        $redis->del($key);
        $data = $this->select(['id', '*'])->fetchAll(\PDO::FETCH_ASSOC | \PDO::FETCH_UNIQUE);
        $flag = explode('_', $this->table);
        $max = count($flag) - 1;
        if ($flag[$max] === 'lang') {
            $temp = [];
            foreach ($data as &$v) {
                $temp[$v[$flag[$max-1].'_id'].'_'.$v['lang_id']] = $v;
            }
            $data = $temp;
        }
        return $redis->hMset($key, $data);
    }

    private function checkAndClear(): array
    {
        $key = md5($this->statement);
        if (!Registry::get('cache')->handle->get($key)) {
            preg_match_all('/`(\w+)`/u', $this->statement, $matches);
            $white = APP_TABLE[$this->table] + [$this->table => []];
            foreach (array_flip($matches[1]) as $column => $index) {
                if (!isset($white[$column])) {
                    throw new \Exception('db hack #'.$index.' ['.$this->statement.']');
                }
            }
            Registry::get('cache')->handle->set($key, true, 3600);
        }
        $data = [$this->statement, $this->parameter];
        $this->__destruct();
        return $data;
    }
}
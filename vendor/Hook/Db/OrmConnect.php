<?php
namespace Hook\Db;

use Redis;
use Yaconf;
use Hook\Db\{OrmConnect, PdoConnect, RedisConnect, YacConnect};
use Hook\Cache\Cache;

class OrmConnect extends Cache
{
    public $table = '';

    private $statement = '';
    private $parameter = [];

    private $operator = ['=' => '=', '>' => '>', '>=' => '>=', '<' => '<', '<=' => '<=', '!=' => '!=', 'LIKE' => 'LIKE', 'NOT LIKE' => 'NOT LIKE', 'IN' => 'IN', 'NOT IN' => 'NOT IN', 'BETWEEN' => 'BETWEEN', 'NOT BETWEEN' => 'NOT BETWEEN', 'AND' => 'AND'];
    private $expression = ['DISTINCT', 'DISTINCTROW'];

    public function __construct(string $table)
    {
        $this->table = $table;
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

    public function where(array $where, string $relationOut = 'AND', string $relationIn = 'AND'): self
    {
        $statement = '';
        $relationOut = $relationOut === 'AND' ? ' AND ' : ' OR ';
        $relationIn = $relationIn === 'AND' ? ' AND ' : ' OR ';
        foreach ($where as $column => $condition) {
            $condition = is_array($condition) ? $condition : ['=' => $condition];
            $statement .= isset($condition['AND']) ? '`'.$column.'`' : '';
            foreach ($condition as $operator => $value) {
                $statement .= (!isset($condition['AND']) ? '`'.$column.'`' : '').' '.$this->operator[$operator].' ';
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

    public function limit(int $offset = 0, int $count = 30): self
    {
        $this->statement .= ' LIMIT ?, ?';
        $this->parameter[] = $offset;
        $this->parameter[] = $count;
        return $this;
    }

    public function fetchAll(int $type = null, int $ttl = 3600)
    {
        return $this->fetchCache('fetchAll', $type, $ttl);
    }

    public function fetch(int $type = null, int $ttl = 3600)
    {
        return $this->fetchCache('fetch', $type, $ttl);
    }

    public function fetchColumn(int $column = 0, int $ttl = 3600)
    {
        return $this->fetchCache('fetchColumn', $column, $ttl);
    }

    public function insert(array $parameter): array
    {
        list($statement, $parameter) = $this->safeCheck('INSERT INTO `'.$this->table.'`(`'.join('`,`', array_keys($parameter)).'`)VALUES(:'.join(',:', array_keys($parameter)).')', $parameter);
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

        list($statement, $parameter) = $this->safeCheck('UPDATE `'.$this->table.'` SET '.substr($statement, 0, -1).' '.$this->statement, array_merge($parameter, $this->parameter));
        return PdoConnect::getInstance()->update($statement, $parameter);
    }

    public function delete(): int
    {
        list($statement, $parameter) = $this->safeCheck('DELETE FROM `'.$this->table.'` '.$this->statement, $this->parameter);
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

    private function safeCheck(string $statement, array $parameter): array
    {
        $key = md5($statement);
        if (!YacConnect::getInstance()->handle->get($key)) {
            preg_match_all('/`(\w+)`/u', $statement, $matches);
            $white = APP_TABLE[$this->table] + [$this->table => []];
            foreach (array_flip($matches[1]) as $column => $index) {
                if (!isset($white[$column])) {
                    throw new \Exception('db hack #'.$index.' ['.$statement.']');
                }
            }
            YacConnect::getInstance()->handle->set($key, true);
        }

        return [$this->statement, $this->parameter, $this->statement = '', $this->parameter = []];
    }

    private function fetchCache(string $callable, int $type = null, int $ttl)
    {
        list($statement, $parameter) = $this->safeCheck($this->statement, $this->parameter);
        return RedisConnect::getInstance()->getHash(
            sprintf(Yaconf::get('const')['table']['cache'], $this->table),
            md5($callable.$type.$statement.igbinary_serialize($parameter)),
            function() use ($callable, $statement, $parameter, $type) {
                return PdoConnect::getInstance()->{$callable}($statement, $parameter, $type);
            },
            $ttl
        );
    }
}
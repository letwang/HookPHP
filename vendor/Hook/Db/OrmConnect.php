<?php
namespace Hook\Db;

use Yaconf;
use Hook\Db\{OrmConnect, PdoConnect, RedisConnect, YacConnect};
use Hook\Cache\Cache;

class OrmConnect extends Cache
{
    private $table = '';

    private $statement = '';
    private $parameter = [];

    private $operator = ['=' => '=', '>' => '>', '>=' => '>=', '<' => '<', '<=' => '<=', '!=' => '!=', 'LIKE' => 'LIKE', 'NOT LIKE' => 'NOT LIKE', 'IN' => 'IN', 'NOT IN' => 'NOT IN', 'BETWEEN' => 'BETWEEN', 'NOT BETWEEN' => 'NOT BETWEEN', 'AND' => 'AND'];
    private $expression = ['DISTINCT', 'DISTINCTROW'];

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
            $this->statement .= 'COUNT(*)';
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
        foreach ($group as $column) {
            $this->statement .= ' `'.$column.'` ,';
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

    public function fetchAll(int $type = null, int $ttl = 3600)
    {
        return $this->getData(__FUNCTION__, $type, $ttl);
    }

    public function fetch(int $type = null, int $ttl = 3600)
    {
        return $this->getData(__FUNCTION__, $type, $ttl);
    }

    public function fetchColumn(int $column = 0, int $ttl = 3600)
    {
        return $this->getData(__FUNCTION__, $column, $ttl);
    }

    public function insert(array $parameter): array
    {
        return PdoConnect::getInstance()->insert(
            $this->checkStatement('INSERT INTO `'.$this->table.'`(`'.join('`,`', array_keys($parameter)).'`)VALUES(:'.join(',:', array_keys($parameter)).')'),
            $parameter
       );
    }

    public function update(array $assignment): int
    {
        $statement = '';
        $parameter = [];
        foreach ($assignment as $column => $value) {
            $statement .= '`'.$column.'`=?,';
            $parameter[] = $value;
        }
        $parameter = array_merge($parameter, $this->parameter);

        return PdoConnect::getInstance()->update(
            $this->checkStatement('UPDATE `'.$this->table.'` SET '.substr($statement, 0, -1).' '.$this->statement),
            $parameter
        );
    }

    public function delete(): int
    {
        $parameter = $this->parameter;
        return PdoConnect::getInstance()->delete(
            $this->checkStatement('DELETE FROM `'.$this->table.'` '.$this->statement),
            $parameter
        );
    }

    private function checkStatement(string $statement): string
    {
        $this->__destruct();

        $key = md5($statement);
        if (!YacConnect::getInstance()->handle->get($key)) {
            preg_match_all('/`(\w+)`/u', $statement, $matches);
            $white = APP_TABLE[$this->table] + [$this->table => [], 'COUNT(*)' => []];
            foreach (array_flip($matches[1]) as $column => $index) {
                if (!isset($white[$column])) {
                    throw new \Exception('db hack #'.$index.' ['.$statement.']');
                }
            }
            YacConnect::getInstance()->handle->set($key, true);
        }

        return $statement;
    }

    private function getData(string $callable, int $type = null, int $ttl)
    {
        $parameter = $this->parameter;
        $statement = $this->checkStatement($this->statement);

        $key = sprintf(Yaconf::get('const')['table']['cache'], $this->table);
        $hashKey = md5($callable.$type.$statement.igbinary_serialize($parameter));

        if (RedisConnect::getInstance()->handle->hExists($key, $hashKey)) {
            return RedisConnect::getInstance()->handle->hGet($key, $hashKey);
        } else {
            $data = PdoConnect::getInstance()->{$callable}($statement, $parameter, $type);
            RedisConnect::getInstance()->handle->hSet($key, $hashKey, $data);
            RedisConnect::getInstance()->handle->expire($key, $ttl);
            return $data;
        }
    }
}
<?php
namespace Hook\Db;

use Yaconf;
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
        parent::__construct();
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
        if ($offset === null) {
            $this->statement .= ' LIMIT ?';
            $this->parameter[] = $count;
        } else {
            $this->statement .= ' LIMIT ?, ?';
            $this->parameter[] = $offset;
            $this->parameter[] = $count;
        }
        return $this;
    }

    public function fetchAll(int $type = null, int $ttl = 3600)
    {
        return $this->getSingleData(__FUNCTION__, $type, $ttl);
    }

    public function fetch(int $type = null, int $ttl = 3600)
    {
        return $this->getSingleData(__FUNCTION__, $type, $ttl);
    }

    public function fetchColumn(int $column = 0, int $ttl = 3600)
    {
        return $this->getSingleData(__FUNCTION__, $column, $ttl);
    }

    public function insert(array $parameter): array
    {
        return $this->pdo->insert(
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

        return $this->pdo->update(
            $this->checkStatement('UPDATE `'.$this->table.'` SET '.substr($statement, 0, -1).' '.$this->statement),
            $parameter
        );
    }

    public function delete(): int
    {
        $parameter = $this->parameter;
        return $this->pdo->delete(
            $this->checkStatement('DELETE FROM `'.$this->table.'` '.$this->statement),
            $parameter
        );
    }

    private function checkStatement(string $statement): string
    {
        $this->__destruct();

        $key = md5($statement);
        if (!$this->yac->handle->get($key)) {
            preg_match_all('/`(\w+)`/u', $statement, $matches);
            $white = APP_TABLE[$this->table] + [$this->table => [], 'COUNT(*)' => []];
            foreach (array_flip($matches[1]) as $column => $index) {
                if (!isset($white[$column])) {
                    throw new \Exception('db hack #'.$index.' ['.$statement.']');
                }
            }
            $this->yac->handle->set($key, true);
        }

        return $statement;
    }

    private function getSingleData(string $callable, int $type = null, int $ttl)
    {
        $parameter = $this->parameter;
        $statement = $this->checkStatement($this->statement);

        if (!$ttl) {
            return $this->pdo->{$callable}($statement, $parameter, $type);
        }

        $key = sprintf(Yaconf::get('const')['table']['single'], $this->table);
        $hashKey = md5($callable.$type.$statement.igbinary_serialize($parameter));

        if ($this->redis->handle->hExists($key, $hashKey)) {
            return $this->redis->handle->hGet($key, $hashKey);
        } else {
            $data = $this->pdo->{$callable}($statement, $parameter, $type);
            $this->redis->handle->hSet($key, $hashKey, $data);
            $this->redis->handle->expire($key, $ttl);
            return $data;
        }
    }

    private static function getJoinData(string $statement, array $parameter, string $callable, int $type, int $ttl)
    {
        if (!$ttl) {
            return $this->pdo->{$callable}($statement, $parameter, $type);
        }
        preg_match_all('/(?:FROM|JOIN)\s+`(\w+)`/isu', $statement, $matches);
        $key = md5($callable.$type.$statement.igbinary_serialize($parameter));

        if ($this->redis->handle->exists($key)) {
            return $this->redis->handle->get($key);
        } else {
            $data = $this->pdo->{$callable}($statement, $parameter, $type);
            $pipe = $this->redis->handle->multi();
            foreach ($matches[1] as $table) {
                $pipe->hSetNx($table, $key, 1);
                $pipe->expire($table, $ttl);
            }
            $pipe->setEx($key, $ttl, $data);
            return $data;
        }
    }

    public static function queryAll(string $statement, array $parameter = [], int $type = PDO::FETCH_ASSOC, int $ttl = 3600)
    {
        return self::getJoinData($statement, $parameter, 'fetchAll', $type, $ttl);
    }

    public static function query(string $statement, array $parameter = [], int $type = PDO::FETCH_ASSOC, int $ttl = 3600)
    {
        return self::getJoinData($statement, $parameter, 'fetch', $type, $ttl);
    }

    public static function queryColumn(string $statement, array $parameter = [], int $column = 0, int $ttl = 3600)
    {
        return self::getJoinData($statement, $parameter, 'fetchColumn', $column, $ttl);
    }

    public static function flush(string $table): bool
    {
        $keys = [];

        $table = sprintf(Yaconf::get('const')['table']['single'], $table);
        $this->redis->handle->exists($table) && $keys[] = $table;

        $table = sprintf(Yaconf::get('const')['table']['join'], $table);
        $this->redis->handle->exists($table) && $keys = array_merge($keys, [$table], $this->redis->handle->hKeys($table));

        $keys && $this->redis->handle->unlink($keys);
        $this->redis->handle->sAdd(Yaconf::get('const')['yac']['expired_key'], $table);
    }
}
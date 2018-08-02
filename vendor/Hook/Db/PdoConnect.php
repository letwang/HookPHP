<?php
namespace Hook\Db;

use Hook\Cache\Cache;

class PdoConnect extends Cache
{
    public $pdo;

    public function __construct(string $node = 'master')
    {
        $dsn = 'mysql:host='.APP_CONFIG['mysql'][$node]['host'].';port='.APP_CONFIG['mysql'][$node]['port'];
        $dsn .= ';dbname='.APP_CONFIG['mysql'][$node]['dbname'].';charset='.APP_CONFIG['mysql'][$node]['charset'];
        $this->pdo = new \PDO(
            $dsn,
            APP_CONFIG['mysql'][$node]['username'],
            APP_CONFIG['mysql'][$node]['passwd'],
            APP_CONFIG['mysql'][$node]['options']
        );
    }

    /**
     * PDO::FETCH_COLUMN | PDO::FETCH_UNIQUE 返回 以第一列为KEY，第二列为VALUE的 数据结构【如果KEY重复，则自动去重且保留最后一个KEY的VALUE】
     * PDO::FETCH_COLUMN | PDO::FETCH_GROUP 返回 以第一列为KEY，第二列为数组VALUE的元素 数据结构【如果KEY重复，则其值自动加入二维数组中】
     * PDO::FETCH_UNIQUE 返回 以第一列为KEY，其余列为数组VALUE的 数据结构【如果KEY重复，则自动去重且保留最后一个KEY的数组VALUE】
     * PDO::FETCH_GROUP 返回 以第一列为KEY，其余列为二数组VALUE的 数据结构【如果KEY重复，则其值自动加入二维数组中】
     * PDO::FETCH_OBJ 返回对象结构
     */
    public function fetchAll(string $statement, array $parameters = [], int $type = \PDO::FETCH_ASSOC): array
    {
        $rs = $this->query($statement, $parameters);
        $results = $rs->fetchAll($type);
        
        return $results;
    }

    //@return mixed[array|object|false]
    public function fetch(string $statement, array $parameters = [], int $type = \PDO::FETCH_ASSOC)
    {
        $rs = $this->query($statement, $parameters);
        $results = $rs->fetch($type);
        
        return $results;
    }

    //@return mixed[string|false]
    public function fetchColumn(string $statement, array $parameters = [], int $column = 0)
    {
        $rs = $this->query($statement, $parameters);
        $results = $rs->fetchColumn($column);
        
        return $results;
    }

    public function insert(string $statement, array $parameters = []): array
    {
        return [
            'rowCount' => $this->query($statement, $parameters)->rowCount(),
            'lastInsertId' => $this->pdo->lastInsertId()
        ];
    }

    public function update(string $statement, array $parameters = []): int
    {
        return $this->query($statement, $parameters)->rowCount();
    }

    public function delete(string $statement, array $parameters = []): int
    {
        return $this->query($statement, $parameters)->rowCount();
    }

    public function query(string $statement, array $parameters = []): \PDOStatement
    {
        $rs = $this->pdo->prepare($statement);
        foreach ($parameters as $index => $value) {
            switch (1) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
                    break;
            }
            $rs->bindValue($index + 1, $value, $type);
        }

        $rs->execute();
        return $rs;
    }
}
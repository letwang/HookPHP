<?php
namespace Let\Db;

use PDO;

class Db extends PDO
{
    public static $instance = [];

    public function __construct(string $dbNode = 'master')
    {
        $config = APP_CONFIG['mysql'][$dbNode];
        $dsn = 'mysql:host='.$config['host'].';port='.$config['port'];
        $dsn .= ';dbname='.$config['dbname'].';charset='.$config['charset'];
        parent::__construct($dsn, $config['username'], $config['passwd'], $config['options']);
    }

    public function __destruct()
    {
        //
    }

    public static function getInstance(string $dbNode = 'master', string $key = 'default'): self
    {
        if (isset(self::$instance[$dbNode][$key])) {
            return self::$instance[$dbNode][$key];
        }
        return self::$instance[$dbNode][$key] = new self($dbNode);
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
        $rs = $this->_query($statement, $parameters);
        $results = $rs->fetchAll($type);
        $rs->closeCursor();
        $rs = null;
        
        return $results;
    }

    //@return mixed[array|object|false]
    public function fetch(string $statement, array $parameters = [], int $type = \PDO::FETCH_ASSOC)
    {
        $rs = $this->_query($statement, $parameters);
        $results = $rs->fetch($type);
        $rs->closeCursor();
        $rs = null;
        
        return $results;
    }

    //@return mixed[string|false]
    public function fetchColumn(string $statement, array $parameters = [], int $column = 0)
    {
        $rs = $this->_query($statement, $parameters);
        $results = $rs->fetchColumn($column);
        $rs->closeCursor();
        $rs = null;
        
        return $results;
    }

    public function insert(string $statement, array $parameters = []): array
    {
        return [
            'rowCount' => $this->_query($statement, $parameters)->rowCount(),
            'lastInsertId' => $this->lastInsertId()
        ];
    }

    public function update(string $statement, array $parameters = []): int
    {
        return $this->_query($statement, $parameters)->rowCount();
    }

    public function delete(string $statement, array $parameters = []): int
    {
        return $this->_query($statement, $parameters)->rowCount();
    }

    private function _query(string $statement, array $parameters = []): \PDOStatement
    {
        $rs = $this->prepare($statement);
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
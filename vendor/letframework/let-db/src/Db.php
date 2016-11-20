<?php
namespace Let\Db;

use PDO;
use Let\Tools\Tools;

class Db extends PDO
{

    public static $options = [
        'master' => [
            'host' => '127.0.0.1',
            'port' => 3306,
            'database' => 'test',
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'username' => 'root',
            'password' => '123456',
            'pdo' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ],
        'slave0' => [
            'host' => '127.0.0.1',
            'port' => 3306,
            'database' => 'mysql',
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'username' => 'root',
            'password' => '123456',
            'pdo' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ],
        'slave1' => [
            'host' => '127.0.0.1',
            'port' => 3306,
            'database' => 'phpmyadmin',
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'username' => 'root',
            'password' => '123456',
            'pdo' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ],
        'slave2' => [
            'host' => '127.0.0.1',
            'port' => 3306,
            'database' => 'performance_schema',
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'username' => 'root',
            'password' => '123456',
            'pdo' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ]
    ];

    public static $connections = [];

    public function __construct($target = 'master')
    {
        $options = self::$options[$target];
        
        if (isset($options['unix_socket'])) {
            $dsn = 'mysql:unix_socket=' . $options['unix_socket'];
        } else {
            $dsn = 'mysql:host=' . $options['host'] . ';port=' . (isset($options['port']) ? $options['port'] : 3306);
        }
        $dsn .= ';charset=' . $options['charset'];
        if (isset($options['database'])) {
            $dsn .= ';dbname=' . $options['database'];
        }
        
        $options += [
            'pdo' => []
        ];
        $options['pdo'] += [
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
            PDO::ATTR_EMULATE_PREPARES => true
        ];
        
        parent::__construct($dsn, $options['username'], $options['password'], $options['pdo']);
        
        $options += [
            'commands' => []
        ];
        
        if (isset($options['collation'])) {
            $options['commands'] += [
                'names' => 'SET NAMES ' . $options['charset'] . ' COLLATE ' . $options['collation']
            ];
        } else {
            $options['commands'] += [
                'names' => 'SET NAMES ' . $options['charset']
            ];
        }
        
        $options['commands'] += [
            'sql_mode' => "SET sql_mode = 'ANSI,STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER'"
        ];
        
        $this->exec(implode('; ', $options['commands']));
    }

    public function __destruct()
    {
        //
    }

    public static function getConnection($target = 'master', $key = 'default')
    {
        if (isset(self::$connections[$target][$key])) {
            return self::$connections[$target][$key];
        }
        self::$connections[$target][$key] = new self($target);
        return self::$connections[$target][$key];
    }

    public function fetchAll($query, array $parameters = [], $type = \PDO::FETCH_ASSOC)
    {
        $rs = $this->query($query, $parameters);
        $results = $rs->fetchAll($type);
        $rs->closeCursor();
        $rs = null;
        
        return $results;
    }

    /**
     * 返回第一行数据组成的一维数组
     *
     * @param string $query            
     * @param array $parameters            
     * @param int $type            
     * @return array
     */
    public function fetch($query, array $parameters = [], $type = \PDO::FETCH_ASSOC)
    {
        $rs = $this->query($query, $parameters);
        $results = $rs->fetch($type);
        $rs->closeCursor();
        $rs = null;
        
        return $results;
    }

    /**
     * 返回第一行指定索引列的值
     *
     * @param string $query            
     * @param array $parameters            
     * @param int $column            
     * @return scalar
     */
    public function fetchColumn($query, array $parameters = [], $column = 0)
    {
        $rs = $this->query($query, $parameters);
        $results = $rs->fetchColumn($column);
        $rs->closeCursor();
        $rs = null;
        
        return $results;
    }

    /**
     * 返回 以第一列为KEY，第二列为VALUE的 数据结构【如果KEY重复，则自动去重且保留最后一个KEY的VALUE】
     *
     * @param string $query            
     * @param array $parameters            
     * @return array
     */
    public function getKV($query, array $parameters = [])
    {
        return $this->fetchAll($query, $parameters, \PDO::FETCH_KEY_PAIR);
    }

    /**
     * 返回 以第一列为KEY，其余列为数组VALUE的 数据结构【如果KEY重复，则自动去重且保留最后一个KEY的数组VALUE】
     *
     * @param string $query            
     * @param array $parameters            
     * @return array
     */
    public function getKVArray($query, array $parameters = [])
    {
        return $this->fetchAll($query, $parameters, \PDO::FETCH_UNIQUE);
    }

    /**
     * 返回 以第一列为KEY，其余列为二数组VALUE的 数据结构【如果KEY重复，则其值自动加入二维数组中】
     *
     * @param string $query            
     * @param array $parameters            
     * @return array
     */
    public function getKVGroup($query, array $parameters = [])
    {
        return $this->fetchAll($query, $parameters, \PDO::FETCH_GROUP);
    }

    public function insert($table, array $data, $type = 0)
    {
        switch ($type) {
            case 0:
                $type === 'INSERT';
                break;
            case 1:
                $type === 'REPLACE';
                break;
            case 2:
                $type === 'INSERT DELAYED';
                break;
            case 3:
                $type === 'REPLACE DELAYED';
            case 4:
                $type === 'INSERT LOW_PRIORITY';
            case 5:
                $type === 'REPLACE LOW_PRIORITY';
            case 6:
                $type === 'INSERT HIGH_PRIORITY';
            case 7:
                $type === 'REPLACE HIGH_PRIORITY';
            case 8:
                $type === 'INSERT HIGH_PRIORITY';
                break;
        }
        return $this->query($type . ' INTO `' . Tools::safeSqlByBacktick($table) . '` (`' . implode('`,`', array_keys($data)) . '`) VALUES (' . implode(',', array_fill(0, count($data), '?')) . ');', array_values($data));
    }

    public function update($table, array $data, $where = '1')
    {
        return $this->query('UPDATE `' . $table . '` SET `' . implode('`=?,`', array_keys($data)) . '`=? WHERE ' . $where . ';', array_values($data));
    }

    public function delete($table, $where = '1')
    {
        return $this->query('DELETE FROM `' . $table . '` WHERE ' . $where . ';');
    }

    public function query($query, array $parameters = [])
    {
        $rs = $this->prepare($query);
        if ($rs) {
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
                $rs->bindValue(($index + 1), $value, $type);
            }
            
            $rs->execute();
            return $rs;
        } else {
            throw new \Exception($query);
        }
    }
}
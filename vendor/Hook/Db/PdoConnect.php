<?php
namespace Hook\Db;

use PDO;
use SeasLog;
use Hook\Tools\Tools;
use Hook\Cache\Cache;

class PdoConnect extends Cache
{
    public object $handle;

    /**
     * 
     * @param string $name
     */
    public function __construct(string $db = '')
    {
        $db = $db ? $db : 'default';
        $dsn = 'mysql:host='.APP_CONFIG['mysql'][$db]['host'].';port='.APP_CONFIG['mysql'][$db]['port'];
        $dsn .= ';dbname='.APP_CONFIG['mysql'][$db]['dbname'].';charset='.APP_CONFIG['mysql'][$db]['charset'];
        $this->handle = new PDO(
            $dsn,
            APP_CONFIG['mysql'][$db]['username'],
            APP_CONFIG['mysql'][$db]['passwd'],
            APP_CONFIG['mysql'][$db]['options']
        );
    }

    /**
     * 返回所有行的数组数据
     * @param string $statement
     * @param array $parameter
     * @param int $type 数据结构：
     * <div><ol>
     * <li>PDO::FETCH_COLUMN
     *  <p>返回第1列，[VALUE构成的索引数组]</p>
     * </li>
     * <li>PDO::FETCH_KEY_PAIR 或使用 PDO::FETCH_COLUMN | PDO::FETCH_UNIQUE
     *  <p>返回前2列，[第一列为KEY => 第二列为VALUE]</p>
     * </li>
     * <li>PDO::FETCH_COLUMN | PDO::FETCH_GROUP
     *  <p>返回前2列，[第一列为KEY => [第二列为VALUE，如果KEY重复，VALUE对应归类]]</p>
     * </li>
     * <li>PDO::FETCH_UNIQUE
     *  <p>返回所有列，[第一列为KEY => [其余列为关联数组]]</p>
     * </li>
     * <li>PDO::FETCH_GROUP
     *  <p>返回所有列，[第一列为KEY => [[其余列为关联数组，如果KEY重复，VALUE对应归类]]]</p>
     * </li>
     * <li>PDO::FETCH_OBJ
     *  <p>返回所有列，对象形式</p>
     * </li>
     * </ol></div>
     * @return array
     */
    public function fetchAll(string $statement, array $parameter = [], int $type = null): array
    {
        return $this->query($statement, $parameter)->fetchAll($type);
    }

    /**
     * 获取第一行数据
     * @param string $statement
     * @param array $parameter
     * @param int $type
     * @return mixed[array|object|false]
     */
    public function fetch(string $statement, array $parameter = [], int $type = null)
    {
        return $this->query($statement, $parameter)->fetch($type);
    }

    /**
     * 获取第一行某列数据：默认第1列
     * @param string $statement
     * @param array $parameter
     * @param int $column
     * @return mixed[string|false]
     */
    public function fetchColumn(string $statement, array $parameter = [], int $column = 0)
    {
        return $this->query($statement, $parameter)->fetchColumn($column);
    }

    /**
     * 返回插入后受影响的行数以及自增ID值
     * @param string $statement
     * @param array $parameter
     * @return array
     */
    public function insert(string $statement, array $parameter = []): array
    {
        return [
            'rowCount' => $this->query($statement, $parameter)->rowCount(),
            'lastInsertId' => (int) $this->handle->lastInsertId()
        ];
    }

    /**
     * 返回更新后受影响的行数
     * @param string $statement
     * @param array $parameter
     * @return int
     */
    public function update(string $statement, array $parameter = []): int
    {
        return $this->query($statement, $parameter)->rowCount();
    }

    /**
     * 返回删除后受影响的行数
     * @param string $statement
     * @param array $parameter
     * @return int
     */
    public function delete(string $statement, array $parameter = []): int
    {
        return $this->query($statement, $parameter)->rowCount();
    }

    /**
     * 根据参数类型，绑定对应类型
     * @param string $statement
     * @param array $parameter
     * @return \PDOStatement
     */
    public function query(string $statement, array $parameter = []): \PDOStatement
    {
        $statement = Tools::formatTableName($statement);
        defined('APP_DEBUG') && APP_DEBUG && SeasLog::log('SQL', $statement.' | '.json_encode($parameter));
        $rs = $this->handle->prepare($statement);
        $flag = isset($parameter[0]);
        foreach ($parameter as $key => $value) {
            switch (1) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
            $rs->bindValue($flag ? ($key + 1) : $key, $value, $type);
        }

        $rs->execute();
        return $rs;
    }
}
<?php
require __DIR__ . '/../Init.php';

/**
 * 从注释中解析可执行代码
 * @param string $method
 * @return string
 */
function getCode(string $method): string
{
    static $content = null;
    if (!$content) {
        $content = file_get_contents(__FILE__);
    }
    preg_match('/([^\}]*?)function '.$method.'\(/isu', $content, $matches);

    return preg_replace(['/\//isu', '/\*\*|\*\s/isu'], '', explode('@example', $matches[1])[1]);
}

/**
 * @example $orm = Hook\Db\OrmConnect::getInstance('hp_iot_config')
 */
function 单表实例化(): object
{
    global $orm;eval(getCode(__METHOD__).";");
    return (new Hook\Db\OrmConnect) instanceof $orm ? $orm : false;
}

/**
 * @example $data = $orm->desc();
 */
function 查看表结构(): array
{
    global $orm;eval(getCode(__METHOD__).";");
    return count($data) === 6 ? $data : false;
}

/**
 * @example $data = $orm->exist();
 */
function 检测表是否存在(): bool
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data ? true : null;
}

/**
 * @example $data = $orm->exist('id');
 */
function 检测字段是否存在(): bool
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data ? true : null;
}

/**
 * @example $data = $orm->select()
 * ->where(['id' => 1])
 * ->limit(1)
 * ->fetchColumn() > 0;
 */
function 检测记录是否存在(): bool
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data ? true : null;
}

/**
 * @example $data = $orm->select([])->where(['id' => ['>' => 0]])->fetchColumn();
 */
function 统计(): string
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data === '4' ? $data : false;
}

/**
 * @example $data = $orm->select(['*'])
 * ->where(['id' => ['>' => 0]])
 * ->group(['status', 'id'])
 * ->order(['status' => 'ASC', 'id' => 'DESC'])
 * ->limit(3, 0)
 * ->fetchAll();
 */
function 查询所有(): array
{
    global $orm;eval(getCode(__METHOD__).";");
    return count($data) === 3 ? $data : false;
}

/**
 * @example $data = $orm->select(['*'])
 * ->where(['id' => 1])
 * ->limit(1)
 * ->fetch();
 */
function 查询一行(): array
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data['id'] === '1' ? $data : false;
}

/**
 * @example $data = $orm->select(['id'])
 * ->where(['id' => 1])
 * ->limit(1)
 * ->fetchColumn();
 */
function 查询一个值(): string
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data === '1' ? $data : false;
}

/**
 * @example $data = $orm->insert(
 * ['status' => 1,'date_add' => microtime(true),'date_upd' => microtime(true),'key' => 'testKey','value' => 'testValue']
 * );
 */
function 插入(): array
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data['lastInsertId'] > 0 ? $data : false;
}

/**
 * @example $data = $orm->where(['key' => 'testKey'])->limit(1)->update(['status' => 2]);
 */
function 更新(): int
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data === 1 ? true : false;
}

/**
 * @example $data = $orm->where(['key' => 'testKey'])->limit(1)->delete();
 */
function 删除(): int
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data === 1 ? true : false;
}

/**
 * @example 任意地方传入任意不存在的字段，系统会自动触发安全警报，达到调试目的
 */
function 调试(): bool
{
    return true;
}

/**
 * @example
 *
$orm = Hook\Db\OrmConnect::getInstance('hp_iot_config')
$orm->select(['*'], ['DISTINCT']);// SELECT DISTINCT
 
//条件 =
$orm->where(['id' => 1, 'status' => 0])->where(['id' => 2, 'status' => 1]);// (id=1 AND status=0) AND (id=2 AND status=1)
 
//条件 =
$orm->where(['id' => 1, 'status' => 0], 'AND', 'OR')->where(['id' => 2, 'status' => 1], 'AND', 'OR');// (id=1 OR status=0) AND (id=2 OR status=1)
 
//条件 =
$orm->where(['id' => ['=' => 3], 'status' => ['=' => 4]], 'OR', 'AND')->where(['id' => ['=' => 5], 'status' => ['=' => 6]], 'OR', 'AND');// (id=3 AND status=4) OR (id=5 AND status=6)
 
//条件 >
$orm->where(['status' => ['>' => 1]]);
 
//条件 >=
$orm->where(['status' => ['>=' => 1]]);
 
//条件 <
$orm->where(['status' => ['<' => 1]]);
 
//条件 <=
$orm->where(['status' => ['<=' => 1]]);
 
//条件 !=
$orm->where(['status' => ['!=' => 1]]);
 
//条件 LIKE
$orm->where(['status' => ['LIKE' => '%1%']]);
 
//条件 NOT LIKE
$orm->where(['status' => ['NOT LIKE' => '%1%']]);
 
//条件 IN
$orm->where(['status' => ['IN' => [1, 2, 3]]]);
 
//条件 NOT IN
$orm->where(['status' => ['NOT IN' => [1, 2, 3]]]);
 
//条件 BETWEEN AND
$orm->where(['status' => ['BETWEEN' => 0, 'AND' => 10]]);
 
//条件 NOT BETWEEN AND
$orm->where(['status' => ['NOT BETWEEN' => 0, 'AND' => 10]]);
 
//条件 IS NULL
$orm->where(['status' => ['IS' => NULL]]);
 
//条件 IS NOT NULL
$orm->where(['status' => ['IS NOT' => NULL]]);
 
//...
var_dump($orm->fetchAll());
 */
function 链式(): bool
{
    return true;
}

/**
 * @example
 * 下面6个方法，默认返回的数据可能需要程序二次加工，不过我们还可以通过PDO自带的参数达到同样的目的，以达到我们想要的数据算法结构：
单表3个查询方法：
    fetchAll()：
        1.fetchAll(PDO::FETCH_COLUMN) //返回第1列，[VALUE构成的索引数组] 【等同 Dbio::queryColumn】
        2.fetchAll(PDO::FETCH_KEY_PAIR) //返回前2列，[第一列为KEY => 第二列为VALUE]
        3.fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_GROUP) //返回前2列，[第一列为KEY => [第二列为VALUE，如果KEY重复，VALUE对应归类]]
        4.fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC) //返回所有列，[第一列为KEY => [其余列为关联数组]]
        5.fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC) //返回所有列，[第一列为KEY => [[其余列为关联数组，如果KEY重复，VALUE对应归类]]]
        6.fetchAll(PDO::FETCH_OBJ) //返回所有列，对象形式
    fetch()：
        调整 $type 参数：默认的基本够用，一般无需调整；用法 类似 单表fetchAll
    fetchColumn()：
        调整 $column 参数：默认值 0
        0 取 第1个字段值
        1 取 第2个字段值
        2 取 第3个字段值
        ...
多表3个查询方法
    queryAll()：
        用法，类似 单表fetchAll
    query()：
        用法，类似 单表fetch
    queryColumn()：
        用法，类似 单表fetchColumn
 */
function 结构(): bool
{
    return true;
}

foreach (get_defined_functions()['user'] as $callback) {
    if (preg_match('/\w+/is', $callback)) {
        continue;
    }
    var_dump($callback . ':' . (call_user_func($callback) ? '成功' : '失败'));
}
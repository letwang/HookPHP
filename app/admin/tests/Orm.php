<?php
declare(strict_types=1);

require __DIR__ . '/../Init.php';

$class = new ORM教程();
$reflection = new ReflectionClass($class);
foreach ($reflection->getMethods() as $method) {
    $例子 = preg_replace(
        ['/@param \$例子 string /', '/<\/?(code|pre)>/', '/\/?\*(\*|\s+|\/)/'],
        '',
        $reflection->getMethod($method->name)->getDocComment()
    );
    var_dump($method->name . ':' . ($class->{$method->name}($例子) ? '成功' : '失败'));
}

class ORM教程
{
    /**
     * @param $例子 string <code>
     * $orm = Hook\Db\OrmConnect::getInstance('hp_iot_config');
     * </code>
     */
    function 单表实例化(string $例子 = ''): object
    {
        global $orm;eval($例子);
        return (new Hook\Db\OrmConnect) instanceof $orm ? $orm : false;
    }

    /**
     * @param $例子 string <code>
     * $data = $orm->desc();
     * </code>
     */
    function 查看表结构(string $例子 = ''): array
    {
        global $orm;eval($例子);
        return count($data) === 6 ? $data : false;
    }

    /**
     * @param $例子 string <code>
     * $data = $orm->exist();
     * </code>
     */
    function 检测表是否存在(string $例子 = ''): bool
    {
        global $orm;eval($例子);
        return $data ? true : null;
    }

    /**
     * @param $例子 string <code>
     * $data = $orm->exist('id');
     * </code>
     */
    function 检测字段是否存在(string $例子 = ''): bool
    {
        global $orm;eval($例子);
        return $data ? true : null;
    }

    /**
     * @param $例子 string <code>
     * $data = $orm->select()
     * ->where(['id' => 1])
     * ->limit(1)
     * ->fetchColumn() > 0;
     * </code>
     */
    function 检测记录是否存在(string $例子 = ''): bool
    {
        global $orm;eval($例子);
        return $data ? true : null;
    }

    /**
     * @param $例子 string <code>
     * $data = $orm->select([])->where(['id' => ['>' => 0]])->fetchColumn();
     * </code>
     */
    function 统计(string $例子 = ''): string
    {
        global $orm;eval($例子);
        return $data === '4' ? $data : false;
    }

    /**
     * @param $例子 string <pre>
     * $data = $orm->select(['*'])
     * ->where(['id' => ['>' => 0]])
     * ->group(['status', 'id'])
     * ->order(['status' => 'ASC', 'id' => 'DESC'])
     * ->limit(3, 0)
     * ->fetchAll();
     * </pre>
     */
    function 查询所有(string $例子 = ''): array
    {
        global $orm;eval($例子);
        return count($data) === 3 ? $data : false;
    }

    /**
     * @param $例子 string <code>
     * $data = $orm->select(['*'])
     * ->where(['id' => 1])
     * ->limit(1)
     * ->fetch();
     * </code>
     */
    function 查询一行(string $例子 = ''): array
    {
        global $orm;eval($例子);
        return $data['id'] === '1' ? $data : false;
    }

    /**
     * @param $例子 string <code>
     * $data = $orm->select(['id'])
     * ->where(['id' => 1])
     * ->limit(1)
     * ->fetchColumn();
     * </code>
     */
    function 查询一个值(string $例子 = ''): string
    {
        global $orm;eval($例子);
        return $data === '1' ? $data : false;
    }

    /**
     * @param $例子 string <pre>
     * $data = $orm->insert(['status' => 1,'date_add' => microtime(true),'date_upd' => microtime(true),'key' => 'testKey','value' => 'testValue']);
     * </pre>
     */
    function 插入(string $例子 = ''): array
    {
        global $orm;eval($例子);
        return $data['lastInsertId'] > 0 ? $data : false;
    }

    /**
     * @param $例子 string <code>
     * $data = $orm->where(['key' => 'testKey'])->limit(1)->update(['status' => 2]);
     * </code>
     */
    function 更新(string $例子 = ''): int
    {
        global $orm;eval($例子);
        return $data === 1 ? true : false;
    }

    /**
     * @param $例子 string <code>
     * $data = $orm->where(['key' => 'testKey'])->limit(1)->delete();
     * </code>
     */
    function 删除(string $例子 = ''): int
    {
        global $orm;eval($例子);
        return $data === 1 ? true : false;
    }

    /**
     * @param $例子 string <code>
     * 任意地方传入任意不存在的字段，系统会自动触发安全警报，达到调试目的
     * </code>
     */
    function 调试(string $例子 = ''): bool
    {
        return true;
    }

    /**
     * @param $例子 string <pre>
     * $orm = Hook\Db\OrmConnect::getInstance('hp_iot_config')
     * $orm->select(['*'], ['DISTINCT']);// SELECT DISTINCT
     * 
     * //条件 =
     * $orm->where(['id' => 1, 'status' => 0])->where(['id' => 2, 'status' => 1]);// (id=1 AND status=0) AND (id=2 AND status=1)
     * 
     * //条件 =
     * $orm->where(['id' => 1, 'status' => 0], 'AND', 'OR')->where(['id' => 2, 'status' => 1], 'AND', 'OR');// (id=1 OR status=0) AND (id=2 OR status=1)
     * 
     * //条件 =
     * $orm->where(['id' => ['=' => 3], 'status' => ['=' => 4]], 'OR', 'AND')->where(['id' => ['=' => 5], 'status' => ['=' => 6]], 'OR', 'AND');// (id=3 AND status=4) OR (id=5 AND status=6)
     * 
     * //条件 >
     * $orm->where(['status' => ['>' => 1]]);
     * 
     * //条件 >=
     * $orm->where(['status' => ['>=' => 1]]);
     * 
     * //条件 <
     * $orm->where(['status' => ['<' => 1]]);
     * 
     * //条件 <=
     * $orm->where(['status' => ['<=' => 1]]);
     * 
     * //条件 !=
     * $orm->where(['status' => ['!=' => 1]]);
     * 
     * //条件 LIKE
     * $orm->where(['status' => ['LIKE' => '%1%']]);
     * 
     * //条件 NOT LIKE
     * $orm->where(['status' => ['NOT LIKE' => '%1%']]);
     * 
     * //条件 IN
     * $orm->where(['status' => ['IN' => [1, 2, 3]]]);
     * 
     * //条件 NOT IN
     * $orm->where(['status' => ['NOT IN' => [1, 2, 3]]]);
     * 
     * //条件 BETWEEN AND
     * $orm->where(['status' => ['BETWEEN' => 0, 'AND' => 10]]);
     * 
     * //条件 NOT BETWEEN AND
     * $orm->where(['status' => ['NOT BETWEEN' => 0, 'AND' => 10]]);
     * 
     * //条件 IS NULL
     * $orm->where(['status' => ['IS' => NULL]]);
     * 
     * //条件 IS NOT NULL
     * $orm->where(['status' => ['IS NOT' => NULL]]);
     *
     * var_dump($orm->fetchAll());
     * </pre>
     */
    function 链式(string $例子 = ''): bool
    {
        return true;
    }

    /**
     * @param $例子 string <pre>
     * 下面6个方法，默认返回的数据可能需要程序二次加工，不过我们还可以通过PDO自带的参数达到同样的目的，以达到我们想要的数据算法结构：<ol>
     * <li>单表3个查询方法：</li><ol>
     * <li>fetchAll()：</li><ol>
     * <li>fetchAll(PDO::FETCH_COLUMN) //返回第1列，[VALUE构成的索引数组] 【等同 Dbio::queryColumn】</li>
     * <li>fetchAll(PDO::FETCH_KEY_PAIR) //返回前2列，[第一列为KEY => 第二列为VALUE]</li>
     * <li>fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_GROUP) //返回前2列，[第一列为KEY => [第二列为VALUE，如果KEY重复，VALUE对应归类]]</li>
     * <li>fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC) //返回所有列，[第一列为KEY => [其余列为关联数组]]</li>
     * <li>fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC) //返回所有列，[第一列为KEY => [[其余列为关联数组，如果KEY重复，VALUE对应归类]]]</li>
     * <li>fetchAll(PDO::FETCH_OBJ) //返回所有列，对象形式</li></ol>
     * <li>fetch()：</li> 调整 $type 参数：默认的基本够用，一般无需调整；用法 类似 单表fetchAll
     * <li>fetchColumn()：</li> 调整 $column 参数：默认值 0<ol>
     * <li>0 取 第1个字段值</li>
     * <li>1 取 第2个字段值</li>
     * <li>2 取 第3个字段值</li>
     * <li>...</li></ol></ol>
     * <li>多表3个查询方法</li><ol>
     * <li>queryAll()：</li> 用法，类似 单表fetchAll
     * <li>query()：</li> 用法，类似 单表fetch
     * <li>queryColumn()：</li> 用法，类似 单表fetchColumn</ol>
     * </ol></pre>
     */
    function 结构(string $例子 = ''): bool
    {
        return true;
    }
}
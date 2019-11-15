<?php
require __DIR__ . '/../Init.php';

/**
 * 从注释中解析可执行代码
 * @param string $method 需要解析文档的方法名
 * @param string $class 类的绝对名称，例如：Hook\\HookModel\\Hook_Hook_ModuleController
 * @return string
 */
function getCode(string $method, string $class = ''): string
{
    if ( !empty($class) ) {
		$reflectionClass  = new ReflectionClass($class);
		$reflectionMethod = $reflectionClass->getMethod($method);
		$doc              = $reflectionMethod->getDocComment();
		if ( empty($doc) ) {
			return false;
		}
		preg_match("/<code>([\s\S]+)<\/code>/", $doc, $matches);

		if ( ! isset($matches[1]) ) {
			return false;
		}
		$result = trim(preg_replace("/(\n\s+\*\s)/i", "\n", $matches[1]));

		return $result;
    }
    static $content = null;
    if (!$content) {
        $content = file_get_contents(__FILE__);
    }
    preg_match('/([^\}]*?)function '.$method.'\(/isu', $content, $matches);
    preg_match('/\<.*?\>(.*?)\<\/.*?\>/isu', $matches[1], $matches);

    return str_replace('* ', '', $matches[1]);
}

/**
 * @param string $例子 <code>
 * $orm = Hook\Db\OrmConnect::getInstance('hp_iot_config')
 </code>*/
function 单表实例化($例子): object
{
    global $orm;eval(getCode(__METHOD__).";");
    return (new Hook\Db\OrmConnect) instanceof $orm ? $orm : false;
}

/**
 * @param string $例子 <code>
 * $data = $orm->desc();
 </code>*/
function 查看表结构($例子): array
{
    global $orm;eval(getCode(__METHOD__).";");
    return count($data) === 6 ? $data : false;
}

/**
 * @param string $例子 <code>
 * $data = $orm->exist();
 </code>*/
function 检测表是否存在($例子): bool
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data ? true : null;
}

/**
 * @param string $例子 <code>
 * $data = $orm->exist('id');
 </code>*/
function 检测字段是否存在($例子): bool
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data ? true : null;
}

/**
 * @param string $例子 <code>
 * $data = $orm->select()
 * ->where(['id' => 1])
 * ->limit(1)
 * ->fetchColumn() > 0;
 </code>*/
function 检测记录是否存在($例子): bool
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data ? true : null;
}

/**
 * @param string $例子 <code>
 * $data = $orm->select([])->where(['id' => ['>' => 0]])->fetchColumn();
 </code>*/
function 统计($例子): string
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data === '4' ? $data : false;
}

/**
 * @param string $例子 <pre>
 * $data = $orm->select(['*'])
 * ->where(['id' => ['>' => 0]])
 * ->group(['status', 'id'])
 * ->order(['status' => 'ASC', 'id' => 'DESC'])
 * ->limit(3, 0)
 * ->fetchAll();
 </pre>*/
function 查询所有($例子): array
{
    global $orm;eval(getCode(__METHOD__).";");
    return count($data) === 3 ? $data : false;
}

/**
 * @param string $例子 <code>
 * $data = $orm->select(['*'])
 * ->where(['id' => 1])
 * ->limit(1)
 * ->fetch();
 </code>*/
function 查询一行($例子): array
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data['id'] === '1' ? $data : false;
}

/**
 * @param string $例子 <code>
 * $data = $orm->select(['id'])
 * ->where(['id' => 1])
 * ->limit(1)
 * ->fetchColumn();
 </code>*/
function 查询一个值($例子): string
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data === '1' ? $data : false;
}

/**
 * @param string $例子 <pre>
 * $data = $orm->insert(['status' => 1,'date_add' => microtime(true),'date_upd' => microtime(true),'key' => 'testKey','value' => 'testValue']);
 </pre>*/
function 插入($例子): array
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data['lastInsertId'] > 0 ? $data : false;
}

/**
 * @param string $例子 <code>
 * $data = $orm->where(['key' => 'testKey'])->limit(1)->update(['status' => 2]);
 </code>*/
function 更新($例子): int
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data === 1 ? true : false;
}

/**
 * @param string $例子 <code>
 * $data = $orm->where(['key' => 'testKey'])->limit(1)->delete();
 </code>*/
function 删除($例子): int
{
    global $orm;eval(getCode(__METHOD__).";");
    return $data === 1 ? true : false;
}

/**
 * @param string $例子 <code>
 * 任意地方传入任意不存在的字段，系统会自动触发安全警报，达到调试目的
 </code>*/
function 调试($例子): bool
{
    return true;
}

/**
 * @param string $例子 <pre>
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

var_dump($orm->fetchAll());
 </pre>*/
function 链式($例子): bool
{
    return true;
}

/**
 * @param string $例子 <pre>
下面6个方法，默认返回的数据可能需要程序二次加工，不过我们还可以通过PDO自带的参数达到同样的目的，以达到我们想要的数据算法结构：<ol>
    <li>单表3个查询方法：</li><ol>
            <li>fetchAll()：</li><ol>
                <li>fetchAll(PDO::FETCH_COLUMN) //返回第1列，[VALUE构成的索引数组] 【等同 Dbio::queryColumn】</li>
                <li>fetchAll(PDO::FETCH_KEY_PAIR) //返回前2列，[第一列为KEY => 第二列为VALUE]</li>
                <li>fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_GROUP) //返回前2列，[第一列为KEY => [第二列为VALUE，如果KEY重复，VALUE对应归类]]</li>
                <li>fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC) //返回所有列，[第一列为KEY => [其余列为关联数组]]</li>
                <li>fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC) //返回所有列，[第一列为KEY => [[其余列为关联数组，如果KEY重复，VALUE对应归类]]]</li>
                <li>fetchAll(PDO::FETCH_OBJ) //返回所有列，对象形式</li></ol>
            <li>fetch()：</li> 调整 $type 参数：默认的基本够用，一般无需调整；用法 类似 单表fetchAll
            <li>fetchColumn()：</li> 调整 $column 参数：默认值 0<ol>
                <li>0 取 第1个字段值</li>
                <li>1 取 第2个字段值</li>
                <li>2 取 第3个字段值</li>
                <li>...</li></ol></ol>
    <li>多表3个查询方法</li><ol>
            <li>queryAll()：</li> 用法，类似 单表fetchAll
            <li>query()：</li> 用法，类似 单表fetch
            <li>queryColumn()：</li> 用法，类似 单表fetchColumn</ol>
</ol></pre>
 */
function 结构($例子): bool
{
    return true;
}

foreach (get_defined_functions()['user'] as $callback) {
    if (preg_match('/\w+/is', $callback)) {
        continue;
    }
    var_dump($callback . ':' . (call_user_func($callback, '') ? '成功' : '失败'));
}

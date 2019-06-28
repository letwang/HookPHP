<?php
isset($app) || exit('请至平台中运行：php app/[admin|iot|paas|payment|store]/bin/install.php'.PHP_EOL);

use Hook\Db\{OrmConnect, PdoConnect, RedisConnect};

function init(string $appName = APP_NAME)
{
    global $app;
    $pdo = PdoConnect::getInstance();

    $pdo->handle->beginTransaction();
    foreach (Yaconf::get('sql.INSTALL.'.($appName === 'admin' ? 'ADMIN' : 'APP').'.STRUCT') as $sql) {
        $sql = str_replace('%d', APP_CONFIG['mysql']['default']['dbname'], $sql);
        $pdo->query($sql);
    }
    foreach (Yaconf::get('sql.INSTALL.'.($appName === 'admin' ? 'ADMIN' : 'APP').'.DATA') as $sql) {
        $pdo->query($sql);
    }
    $result = $pdo->handle->commit();

    $data = '';
    $redis = RedisConnect::getInstance()->handle;
    foreach ($pdo->fetchAll(Yaconf::get('sql.TABLE.GET_ALL'), [APP_CONFIG['application']['prefix'].$appName.'_%'], PDO::FETCH_NUM) as list($table)) {
        $orm = OrmConnect::getInstance($table);
        $redis->del(sprintf(Yaconf::get('const')['table']['meta'], $table));
        foreach ($orm->select(['*'])->fetchAll() as $value) {
            $result &= synData(['table' => $table, 'eventType' => 'INSERT', 'after' => $value], $redis);
        }
        $data .= '['.$table.']'.PHP_EOL;
        foreach ($pdo->fetchAll('DESC `'.$table.'`') as $field) {
            $data .= $field['Field'].'.type='.substr($field['Type'], 0, strpos($field['Type'], '(')).PHP_EOL;
            $data .= $field['Field'].'.null='.$field['Null'].PHP_EOL;
            $data .= $field['Field'].'.key='.$field['Key'].PHP_EOL;
            $data .= $field['Field'].'.default='.$field['Default'].PHP_EOL;
            $data .= $field['Field'].'.extra='.$field['Extra'].PHP_EOL;

            $validate = validate($field['Type']);
            $data .= $field['Field'].'.min='.$validate['min'].PHP_EOL;
            $data .= $field['Field'].'.max='.$validate['max'].PHP_EOL;
        }
        $data .= PHP_EOL;
    }
    $result &= file_put_contents(getcwd().'/conf/'.$appName.'_table.ini', $data) > 0;
    shell_exec('sudo service php7.3-fpm restart');

    echo "初始化\e[3".($result ? 2 : 1)."m ".$appName." \e[0m平台数据完毕\n";
}

function synData(array $data, \Redis $redis): bool
{
    $key = sprintf(Yaconf::get('const')['table']['meta'], $data['table']);
    $hashkey = $data['after']['id'].(substr($data['table'], -4) === 'lang' ? '_'.$data['after']['lang_id'] : '');
    $value = $data['after'];
    switch ($data['eventType']) {
        case 'INSERT':
            $redis->hSetNx($key, $hashkey, $value);
            break;
        case 'UPDATE':
            $redis->hSet($key, $hashkey, $value);
            break;
        case 'DELETE':
            $redis->hDel($key, $hashkey);
            break;
    }

    $redis->del(sprintf(Yaconf::get('const')['table']['cache'], $data['table']));
    $redis->sAdd(Yaconf::get('const')['yac']['expired_key'], $data['table']);

    return true;
}

function validate(string $type): array
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
            $type = array_flip(preg_replace(['/enum\(/', '/\)/', '/\'/'], '', explode("','", $type)));
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
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
        $redis->del(sprintf(Yaconf::get('const')['table']['table'], $table));
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

            $validate = $orm->validate($field['Type']);
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
    $key = sprintf(Yaconf::get('const')['table']['table'], $data['table']);
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
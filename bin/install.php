<?php
isset($app) || exit('请至平台中运行：php app/[admin|iot|paas|payment|store]/bin/install.php'.PHP_EOL);

use Hook\Db\{PdoConnect, OrmConnect, RedisConnect};

function admin() {
    global $app;
    $pdo = PdoConnect::getInstance();
    $pdo->handle->beginTransaction();

    foreach (Yaconf::get('sql.INSTALL.ADMIN.STRUCT') as $sql) {
        $pdo->query(str_replace('%database%', APP_CONFIG['mysql']['default']['dbname'], $sql));
    }

    foreach (Yaconf::get('sql.INSTALL.ADMIN.DATA') as $sql) {
        $pdo->query($sql);
    }

    if ($pdo->handle->commit()) {
        echo "初始化\e[32m admin \e[0m平台数据完毕\n", PHP_EOL;
    }

    $app->execute('init', $pdo, 'admin');
}

function app() {
    global $app;
    $pdo = PdoConnect::getInstance();
    $pdo->handle->beginTransaction();

    foreach (Yaconf::get('sql.INSTALL.APP.STRUCT') as $sql) {
        $pdo->query(str_replace('%s_', APP_NAME.'_', $sql));
    }

    foreach (Yaconf::get('sql.INSTALL.APP.DATA') as $sql) {
        $pdo->query(str_replace('%s_', APP_NAME.'_', $sql));
    }

    if ($pdo->handle->commit()) {
        echo "初始化\e[32m ".APP_NAME." \e[0m平台数据完毕\n", PHP_EOL;
    }
    $app->execute('init', $pdo, APP_NAME);
}

function init(PdoConnect $pdo, string $appName) {
    $data = '';
    $redis = RedisConnect::getInstance()->handle;
    foreach ($pdo->fetchAll(Yaconf::get('sql.TABLE.GET_ALL'), ['hp_'.$appName.'_%'], PDO::FETCH_NUM) as list($table)) {
        $orm = OrmConnect::getInstance($table);
        $redis->del(sprintf(Yaconf::get('const')['table']['syn'], $table));
        foreach ($orm->select(['*'])->fetchAll() as $value) {
            synData(['table' => $table, 'eventType' => 'INSERT', 'after' => $value], $redis);
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
    file_put_contents(getcwd().'/conf/'.$appName.'_table.ini', $data);
    shell_exec('sudo service php7.3-fpm restart');
}

function synData(array $data, \Redis $redis)
{
    $key = sprintf(Yaconf::get('const')['table']['syn'], $data['table']);
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
    $redis->sAdd(Yaconf::get('const')['yac']['expire_keys'], $key);

    $redis->del(sprintf(Yaconf::get('const')['table']['cache'], $data['table']));
}
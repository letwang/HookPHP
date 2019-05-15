<?php
isset($app) || exit('请至平台中运行：php app/[admin|iot|paas|payment|store]/bin/install.php'.PHP_EOL);

use Hook\Db\{PdoConnect, OrmConnect};
use Hook\Sql\{Install};

function admin() {
    global $app;
    $pdo = PdoConnect::getInstance();
    $pdo->handle->beginTransaction();

    foreach (Install::CREATE_ADMIN_STRUCT as $sql) {
        $pdo->query(str_replace('%database%', APP_CONFIG['mysql']['default']['dbname'], $sql));
    }

    foreach (Install::CREATE_ADMIN_DATA as $sql) {
        $pdo->query($sql);
    }

    if ($pdo->handle->commit()) {
        echo "初始化\e[32m admin \e[0m平台数据完毕\n", PHP_EOL;
    }

    $app->execute('main', $pdo, 'admin');
}

function app() {
    global $app;
    $pdo = PdoConnect::getInstance();
    $pdo->handle->beginTransaction();

    foreach (Install::CREATE_APP_STRUCT as $sql) {
        $pdo->query(str_replace('%s_', APP_NAME.'_', $sql));
    }

    foreach (Install::CREATE_APP_DATA as $sql) {
        $pdo->query(str_replace('%s_', APP_NAME.'_', $sql));
    }

    if ($pdo->handle->commit()) {
        echo "初始化\e[32m ".APP_NAME." \e[0m平台数据完毕\n", PHP_EOL;
    }
    $app->execute('main', $pdo, APP_NAME);
}

function main(PdoConnect $pdo, string $appName) {
    $data = '';
    foreach ($pdo->fetchAll(\Hook\Sql\Table::GET_ALL, ['hp_'.$appName.'_%'], PDO::FETCH_NUM) as list($tableName)) {
        $orm = OrmConnect::getInstance($tableName);
        $orm->synData();
        $data .= '['.$tableName.']'.PHP_EOL;
        foreach ($pdo->fetchAll('DESC `'.$tableName.'`') as $field) {
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
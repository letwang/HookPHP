<?php
use Hook\Db\{PdoConnect, Orm};
use Hook\Sql\{Install};

require __DIR__.'/../init.php';

$app = new Yaf\Application(['application' => APP_CONFIG['application']]);

$name = 'default';
$dsn = 'mysql:host='.APP_CONFIG['mysql'][$name]['host'].';port='.APP_CONFIG['mysql'][$name]['port'];
$dsn .= ';charset='.APP_CONFIG['mysql'][$name]['charset'];
$pdo = new \PDO(
    $dsn,
    APP_CONFIG['mysql'][$name]['username'],
    APP_CONFIG['mysql'][$name]['passwd'],
    APP_CONFIG['mysql'][$name]['options']
);
$pdo->query('DROP DATABASE IF EXISTS `'.APP_CONFIG['mysql'][$name]['dbname'].'`');
echo "删除数据库 \e[32m 成功 \e[0m\n", PHP_EOL;

$pdo->query('CREATE DATABASE `'.APP_CONFIG['mysql'][$name]['dbname'].'`');
echo "创建数据库 \e[32m 成功 \e[0m\n", PHP_EOL;

$pdo = PdoConnect::getInstance();
$pdo->query(Install::CREATE_DATA);
echo "初始化数据库 \e[32m 成功 \e[0m\n", PHP_EOL;

$app->execute('main', $pdo);
function main($pdo) {
    $data = '';
    foreach ($pdo->fetchAll(\Hook\Sql\Table::GET_ALL, [], PDO::FETCH_NUM) as list($tableName)) {
        $orm = Orm::getInstance($tableName);
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
    
    file_put_contents(APP_ROOT.'/../../conf/'.APP_NAME.'_table.ini', $data);
    shell_exec('sudo service php7.2-fpm restart');
}
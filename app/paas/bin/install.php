<?php
use Hook\Db\{PdoConnect, Table};
use Hook\Sql\{Install, Init};

require __DIR__.'/../init.php';

$app = new Yaf\Application(['application' => APP_CONFIG['application']]);

$name = 'default';
PdoConnect::getInstance()->query('DROP DATABASE `'.APP_CONFIG['mysql'][$name]['dbname'].'`');
echo "删除数据库 \e[32m 成功 \e[0m\n", PHP_EOL;

PdoConnect::getInstance()->query('CREATE DATABASE `'.APP_CONFIG['mysql'][$name]['dbname'].'`');
echo "创建数据库 \e[32m 成功 \e[0m\n", PHP_EOL;

PdoConnect::getInstance($name, 'new')->query(Install::SQL_TABLES);
echo "初始化数据库 \e[32m 成功 \e[0m\n", PHP_EOL;

$app->execute('main', $name);
function main($name) {
    $data = '';
    $tables = PdoConnect::getInstance($name, 'new')->fetchAll(Init::SQL_ALL_TABLES, [], PDO::FETCH_NUM);
    foreach ($tables as list($tableName)) {
        $table = new Table($tableName);
        $data .= '['.$tableName.']'.PHP_EOL;
        foreach ($table->field as $field) {
            $data .= $field['Field'].'.type='.substr($field['Type'], 0, strpos($field['Type'], '(')).PHP_EOL;
            $data .= $field['Field'].'.null='.$field['Null'].PHP_EOL;
            $data .= $field['Field'].'.key='.$field['Key'].PHP_EOL;
            $data .= $field['Field'].'.default='.$field['Default'].PHP_EOL;
            $data .= $field['Field'].'.extra='.$field['Extra'].PHP_EOL;
            
            $validate = $table->validate($field['Field']);
            $data .= $field['Field'].'.min='.$validate['min'].PHP_EOL;
            $data .= $field['Field'].'.max='.$validate['max'].PHP_EOL;
        }
        $data .= PHP_EOL;
    }
    
    file_put_contents(APP_ROOT.'/../../conf/'.APP_NAME.'_table.ini', $data);
    shell_exec('sudo service php7.2-fpm restart');
}
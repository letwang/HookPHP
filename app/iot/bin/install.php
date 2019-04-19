<?php
use Hook\Db\{PdoConnect, OrmConnect};
use Hook\Sql\{Install};

require __DIR__.'/../init.php';

$database = APP_CONFIG['mysql']['default']['dbname'];

$pdo = PdoConnect::getInstance();

$pdo->query('USE '.$database.';SET FOREIGN_KEY_CHECKS = 0;');
$pdo->query(str_replace('%s_', APP_NAME.'_', Install::CREATE_APP_STRUCT));
$pdo->query(str_replace('%s_', APP_NAME.'_', Install::CREATE_APP_DATA));

echo "初始化\e[32m ".APP_NAME." \e[0m平台数据完毕\n", PHP_EOL;

$app->execute('main', $pdo);

function main($pdo) {
    $data = '';
    foreach ($pdo->fetchAll(\Hook\Sql\Table::GET_ALL, ['hp_'.APP_NAME.'_%'], PDO::FETCH_NUM) as list($tableName)) {
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
    file_put_contents(getcwd().'/conf/'.APP_NAME.'_table.ini', $data);
}
shell_exec('sudo service php7.3-fpm restart');
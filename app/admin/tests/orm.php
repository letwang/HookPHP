<?php
require __DIR__.'/../init.php';

# 单表实例化
$orm = Hook\Db\OrmConnect::getInstance('hp_iot_config');
var_dump(is_object($orm));

# 查看表结构
$data = $orm->desc();
var_dump(isset($data['id']['type']));

# 表是否存在
$data = $orm->exist();
var_dump($data);

# 字段是否存在
$data = $orm->exist('id');
var_dump($data);

# 统计
$data = $orm->select([])
->where(['id' => ['BETWEEN' => 0, 'AND' => 10]])
->where(['date_add' => ['!=' => 1]])
->where(['key' => ['!=' => 'no'], 'status' => ['!=' => 6], 'id' => ['IN' => [1, 2, 3]]], 'AND', 'OR')
->where(['date_add' => ['!=' => 7]])
->fetchColumn();
var_dump($data === '3');

# 查询所有
$data = $orm->select(['*'])
->where(['id' => ['BETWEEN' => 0, 'AND' => 10]])
->where(['date_add' => ['!=' => 1]])
->where(['key' => ['!=' => 'no'], 'status' => ['!=' => 6], 'id' => ['IN' => [1, 2, 3]]], 'AND', 'OR')
->where(['date_add' => ['!=' => 7]])
->group(['status', 'id'])
->order(['status' => 'ASC', 'id' => 'DESC'])
->limit(3, 0)
->fetchAll();
var_dump(count($data) === 3);

# 插入
$insert = $orm->insert(
    [
        'status' => 1,
        'date_add' => microtime(true),
        'date_upd' => microtime(true),
        'key' => 'testKey',
        'value' => 'testValue'
    ]
);
var_dump($insert['lastInsertId'] > 0);

# 查询一行
$data = $orm->select(['*'])
->where(['id' => ['BETWEEN' => 0, 'AND' => 10]])
->where(['date_add' => ['!=' => 1]])
->where(['key' => ['!=' => 'no'], 'status' => ['!=' => 6], 'id' => ['IN' => [1, 2, 3]]], 'AND', 'OR')
->where(['date_add' => ['!=' => 7]])
->group(['status', 'id'])
->order(['status' => 'ASC', 'id' => 'DESC'])
->limit(1)
->fetch();
var_dump($data['id'] === '3');

# 更新
$data = $orm->where(['id' => $insert['lastInsertId']])->limit(50)->update(['status' => 2]);
var_dump($data === 1);

# 查询第一行的第一个字段
$data = $orm->select(['*'])
->where(['id' => ['BETWEEN' => 0, 'AND' => 10]])
->where(['date_add' => ['!=' => 1]])
->where(['key' => ['!=' => 'no'], 'status' => ['!=' => 6], 'id' => ['IN' => [1, 2, 3]]], 'AND', 'OR')
->where(['date_add' => ['!=' => 7]])
->group(['status', 'id'])
->order(['status' => 'ASC', 'id' => 'DESC'])
->limit(1)
->fetchColumn();
var_dump($data === '3');

# 删除
$data = $orm->where(['id' => $insert['lastInsertId']])->limit(100)->delete();
var_dump($data === 1);
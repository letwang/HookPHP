# 实例化单表
```
$orm = Hook\Db\OrmConnect::getInstance('hp_iot_config');
```
# 查看表结构
```
$orm->desc();
```
# 表是否存在
```
$orm->exist();
```
# 字段是否存在
```
$orm->exist('id');
```
# 查询
```
$orm->select()->fetchAll(); #SELECT `id` FROM `hp_iot_config`
$orm->select([], [])->fetchAll(); #SELECT 1 FROM `hp_iot_config`

$orm->select(['id', 'key'])->fetchAll(); #SELECT `id`,`key` FROM `hp_iot_config`
$orm->select(['id', 'key'], ['DISTINCTROW'])->fetchAll(); #SELECT DISTINCTROW`id`,`key` FROM `hp_iot_config`

$orm->select(['*'])->fetch(); #SELECT `*` FROM `hp_iot_config`
$orm->select(['*'])->fetchColumn();  #SELECT `*` FROM `hp_iot_config`
$orm->select(['*'])->fetchAll(); #SELECT `*` FROM `hp_iot_config`

$orm->select(['*'], ['SQL_CALC_FOUND_ROWS', 'DISTINCT'])->fetchAll(); #SELECT SQL_CALC_FOUND_ROWS DISTINCT`*` FROM `hp_iot_config`
$orm->count(); #SELECT FOUND_ROWS()

$orm->select()
	->where(['id' => ['BETWEEN' => 1, 'AND' => 10]])
	->where(['date_add' => 1])
	->where(['app_id' => ['<' => 2], 'status' => 3, 'id' => ['IN' => [4, 4, 4]]], 'AND', 'OR')
	->where(['date_add' => 5])
	->group(['app_id' => 'ASC', 'id' => 'DESC'])
	->order(['app_id' => 'ASC', 'id' => 'DESC'])
	->limit(30, 30)
	->fetchAll(); #SELECT `id` FROM `hp_iot_config` WHERE (`id` BETWEEN ? AND ?) AND (`date_add` = ?) AND (`app_id` < ? OR `status` = ? OR `id` IN (?,?,?)) AND (`date_add` = ?) GROUP BY `app_id` ASC, `id` DESC ORDER BY `app_id` ASC, `id` DESC LIMIT 30,30
```
# 插入
```
$data = $orm->insert([
	'app_id' => 1,
	'status' => 1,
	'date_add' => time(true),
	'date_upd' => time(true),
	'key' => 'testKey',
	'value' => 'testValue',
]); #INSERT INTO `hp_iot_config`(`app_id`,`status`,`date_add`,`date_upd`,`key`,`value`)VALUES(:app_id,:status,:date_add,:date_upd,:key,:value)
```
# 更新
```
$orm->where(['id' => $data['lastInsertId']])->limit(0, 50)->update([
	'app_id' => 1,
	'status' => 2,
	'date_add' => time(true),
	'date_upd' => time(true),
	'key' => 'testKey',
	'value' => 'testValue',
]); #UPDATE `hp_iot_config` SET `app_id`=?,`status`=?,`date_add`=?,`date_upd`=?,`key`=?,`value`=?WHERE (`id`=?) LIMIT 50
```
# 删除
```
$orm->where(['id' => $data['lastInsertId']])->limit(0, 100)->delete(); #DELETE FROM `hp_iot_config` WHERE (`id`=?) LIMIT 100
```
# 验证
```
$orm->validate('tinyint(3) unsigned');
```
# 同步
```
$orm->synData(); #SELECT `id`,`*` FROM `hp_iot_config`
```
```
$orm = Hook\Db\OrmConnect::getInstance('hp_config');
```
# 查看表结构
```
$orm->desc();
```
# 表是否存在
```
$orm->exist();
```
# 查询
```
$orm->select()->fetchAll();#SELECT `id` FROM `hp_config`
$orm->select([], [])->fetchAll();

$orm->select(['id', 'key'])->fetchAll());
$orm->select(['id', 'key'], ['DISTINCTROW'])->fetchAll();

$orm->select(['*'])->fetch();
$orm->select(['*'])->fetchColumn();
$orm->select(['*'])->fetchAll());

$orm->select(['*'], ['SQL_CALC_FOUND_ROWS', 'DISTINCT'])->fetchAll();
$orm->count();

$orm->select()
	->where(['date_add' => 1])
	->where(['app_id' => ['<' => 2], 'status' => 3, 'id' => ['IN' => [4, 4, 4]]], 'AND', 'OR')
	->where(['date_add' => 5])
	->group(['app_id' => 'ASC', 'id' => 'DESC'])
	->order(['app_id' => 'ASC', 'id' => 'DESC'])
	->limit(30, 30)
	->fetchAll());
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
]);
```
# 更新
```
$orm->where(['id' => $data['lastInsertId']])->limit(50)->update([
	'app_id' => 1,
	'status' => 2,
	'date_add' => time(true),
	'date_upd' => time(true),
	'key' => 'testKey',
	'value' => 'testValue',
]);
```
# 删除
```
$orm->where(['id' => $data['lastInsertId']])->limit(100)->delete();
```
# 验证
```
$orm->validate('tinyint(3) unsigned');
```
# 同步
```
$orm->synData();
```

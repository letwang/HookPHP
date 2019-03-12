<?php
namespace Base;

use Hook\Db\{PdoConnect, RedisConnect, Orm};
use Hook\Cache\Cache;
use Hook\Validate\Validate;
use Hook\Tools\Tools;

abstract class AbstractModel extends Cache
{
    public static $table;
    public static $foreign;

    public $id;

    public $fields = [];
    public $ignore = [];

    const INT = 1;
    const BOOL = 2;
    const FLOAT = 3;
    const DATE = 4;
    const NOTHING = 6;

    public function __construct(int $id = null)
    {
        $this->id = $id;
        $this->ignore = ['id' => true, 'app_id' => true, 'date_add' => true, 'date_upd' => true, 'lang_id' => true, static::$foreign => true];
    }

    public static function getData(string $table = null, int $id = null, int $langId = null)
    {
        $table = $table ?? static::$table;
        if (substr($table, -4) === 'lang') {
            $id = $id ? ($id.'_'.($langId ?? APP_LANG_ID)) : $id;
        }

        $data = &Cache::static(__METHOD__);
        if (isset($data[$table][$id])) {
            return $data[$table][$id];
        }

        $key = 'table:'.$table;
        $redis = RedisConnect::getInstance()->redis;
        $data[$table][$id] = $id ? $redis->hGet($key, $id) : $redis->hGetAll($key);
        return $data[$table][$id];
    }

    public function post(): int
    {
        $this->beforePost();
        $this->copyFromPost();
        try {
            PdoConnect::getInstance()->pdo->beginTransaction();

            $parameter = $this->getFields();
            $parameter += isset(APP_TABLE[static::$table]['app_id']) ? ['app_id' => APP_ID]: [];
            $parameter += isset(APP_TABLE[static::$table]['date_add']) ? ['date_add' => time()] : [];

            $orm = Orm::getInstance(static::$table);
            $result = $orm->insert($parameter);

            $lang = $this->getFieldsLang();
            if ($lang) {
                $orm = Orm::getInstance(static::$table.'_lang');
                foreach ($lang as $langId => $parameter) {
                    $parameter += ['lang_id' => $langId, static::$foreign => $result['lastInsertId']];
                    $orm->insert($parameter);
                }
            }

            return PdoConnect::getInstance()->pdo->commit() && $this->afterPost($result['lastInsertId']) ? $result['lastInsertId']: 0;
        } catch (\Throwable $e) {
            PdoConnect::getInstance()->pdo->rollBack();
            AbstractController::send([], 100003, $e->getMessage(), 500);
        }
    }

    public function delete(): bool
    {
        $this->beforeDelete();
        try {
            PdoConnect::getInstance()->pdo->beginTransaction();

            $orm = Orm::getInstance(static::$table);
            $orm->where(['id' => $this->id])->delete();
            return PdoConnect::getInstance()->pdo->commit() && $this->afterDelete();
        } catch (\Throwable $e) {
            PdoConnect::getInstance()->pdo->rollBack();
            AbstractController::send([], 100005, $e->getMessage(), 500);
        }
    }

    public function put(): bool
    {
        $this->beforePut();
        $this->copyFromPost();
        try {
            PdoConnect::getInstance()->pdo->beginTransaction();

            $orm = Orm::getInstance(static::$table);
            $orm->where(['id' => $this->id])->update($this->getFields());

            $lang = $this->getFieldsLang();
            if ($lang) {
                $orm = Orm::getInstance(static::$table.'_lang');
                foreach ($lang as $langId => $parameter) {
                    $orm->where([static::$foreign => $this->id, 'lang_id' => $langId])->update($parameter);
                }
            }

            return PdoConnect::getInstance()->pdo->commit() && $this->afterPut();
        } catch (\Throwable $e) {
            PdoConnect::getInstance()->pdo->rollBack();
            AbstractController::send([], 100004, $e->getMessage(), 500);
        }
    }

    public function get()
    {
        return array_values(self::getData(null, $this->id));
    }

    private function getFields(): array
    {
        $this->validateFields();
        $fields = $this->formatFields();
        return $fields;
    }

    private function getFieldsLang(): array
    {
        if (!static::$foreign) {
            return [];
        }

        $this->validateFieldsLang();
        $fields = [];
        foreach (\LangModel::getIds() as $langId) {
            $fields[$langId] = $this->formatFields($langId);
        }
        return $fields;
    }

    private function validateFields(bool $exit = true, bool $return = false)
    {
        foreach ($this->getDefinition(static::$table) as $field) {
            $message = $this->validateField($field, $this->{$field});
            if ($message !== '') {
                if ($exit) {
                    throw new \Exception($message);
                }
                return $return ? $message : false;
            }
        }
        return true;
    }

    private function validateFieldsLang(bool $exit = true, bool $return = false)
    {
        foreach ($this->getDefinition(static::$table.'_lang') as $field) {
            foreach ($this->$field as $langId => $value) {
                $message = $this->validateField($field, $value, $langId);
                if ($message !== '') {
                    if ($exit) {
                        throw new \Exception($message);
                    }
                    return $return ? $message : false;
                }
            }
        }
        return true;
    }

    private function validateField(string $field, $value, $langId = null): string
    {
        $desc = APP_TABLE[static::$table][$field] ?? APP_TABLE[static::$table.'_lang'][$field];

        if (!empty($this->fields[$field]['require']) && Validate::isEmpty($value)) {
            if ($langId) {
                $value = $this->{$field}[$langId] = $this->{$field}[APP_LANG_ID] ?: $desc['default'];
            } else {
                $value = $this->$field = $desc['default'];
            }
            if (Validate::isEmpty($value)) {
                return sprintf('The %s field is required.', $field);
            }
        }

        if (strpos($desc['type'], 'int') === false) {
            $length = mb_strlen($value);
            if ($length > $desc['max']) {
                return sprintf('The length of property %s is currently %d chars. It must be between %d and %d chars.', $field, $length, $desc['min'], $desc['max']);
            }
        } else {
            if ($value < $desc['min'] || $value > $desc['max']) {
                return sprintf('The %s field must be from %d to %d', $field, $desc['min'], $desc['max']);
            }
        }
        if (isset($this->fields[$field]['validate']) && !call_user_func(['Hook\Validate\Validate', $this->fields[$field]['validate']], $value)) {
            return sprintf('The %s field is invalid.', $field);
        }
        return '';
    }

    private function formatFields(int $langId = null): array
    {
        $fields = [];
        if ($langId) {
            foreach ($this->getDefinition(static::$table.'_lang') as $field) {
                $fields[$field] = $this->formatValue($this->{$field}[$langId], $this->fields[$field]['type'] ?? null);
            }
        } else {
            foreach ($this->getDefinition(static::$table) as $field) {
                $fields[$field] = $this->formatValue($this->$field, $this->fields[$field]['type'] ?? null);
            }
            $fields += isset(APP_TABLE[static::$table]['date_upd']) ? ['date_upd' => time()] : [];
        }
        return $fields;
    }

    private function formatValue($value, int $type = null)
    {
        switch ($type) {
            case self::INT:
                return (int) $value;
            case self::BOOL:
                return (int) $value;
            case self::FLOAT:
                return (float) $value;
            case self::DATE:
                return Tools::dateFormat($value);
            case self::NOTHING:
                return $value;
            default:
                return Tools::safeOutPut($value);
        }
    }

    protected function copyFromPost()
    {
        foreach ($this->getDefinition(static::$table) as $field) {
            $this->{$field} = $_POST[$field] ?? null;
        }

        foreach ($this->getDefinition(static::$table.'_lang') as $field) {
            foreach (\LangModel::getIds() as $langId) {
                $this->{$field}[$langId] = $_POST[$field.'_'.$langId] ?? null;
            }
        }
    }

    protected function getDefinition(string $table): array
    {
        $data = &Cache::static(__METHOD__);
        if (isset($data[$table])) {
            return $data[$table];
        }
        return $data[$table] = isset(APP_TABLE[$table]) ? array_keys(array_diff_key(APP_TABLE[$table], $this->ignore)) : [];
    }

    protected function beforePost(): bool
    {
        return true;
    }

    protected function afterPost(int $id): bool
    {
        $callback = function(\Redis $redis) use ($id) {
            $orm = Orm::getInstance(static::$table);
            $redis->hSet(
                'table:'.$orm->table, $id,
                $orm->select(['*'])->where(['id' => $id])->fetch()
            );
            if (isset(APP_TABLE[static::$table.'_lang'])) {
                $orm = Orm::getInstance(static::$table.'_lang');
                foreach (\LangModel::getIds() as $langId) {
                    $redis->hSet(
                        'table:'.$orm->table, $id.'_'.$langId,
                        $orm->select(['*'])->where([static::$foreign => $id, 'lang_id' => $langId])->fetch()
                    );
                }
            }
        };
        RedisConnect::getInstance()->multi($callback);
        return true;
    }

    protected function beforePut(): bool
    {
        return true;
    }

    protected function afterPut(): bool
    {
        return $this->afterPost($this->id);
    }

    protected function beforeDelete(): bool
    {
        return true;
    }

    protected function afterDelete(): bool
    {
        $callback = function(\Redis $redis) {
            $redis->hDel('table:'.static::$table, $this->id);
            if (isset(APP_TABLE[static::$table.'_lang'])) {
                $param = ['table:'.static::$table.'_lang'];
                foreach (\LangModel::getIds() as $langId) {
                    $param[] = $this->id.'_'.$langId;
                }
                call_user_func_array(array($redis, 'hDel'), $param);
            }
        };
        RedisConnect::getInstance()->multi($callback);
        return true;
    }
}

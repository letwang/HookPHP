<?php
use Hook\Db\{PdoConnect,RedisConnect,Orm};
use Hook\Cache\Cache;
use Hook\Validate\Validate;
use Hook\Tools\Tools;

abstract class AbstractModel
{
    public static $table;
    public static $foreign;

    public $id;
    public $appId;
    public $langId;

    public $ignore = [];

    const INT = 1;
    const BOOL = 2;
    const FLOAT = 3;
    const DATE = 4;
    const HTML = 5;
    const NOTHING = 6;

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        $this->id = $id;
        $this->appId = $appId ?? 1;
        $this->langId = $langId;

        $this->ignore = ['id' => true, 'app_id' => true, 'date_add' => true, 'date_upd' => true, 'lang_id' => true, static::$foreign => true];
    }

    public function create(): int
    {
        $this->beforeCreate();
        $this->copyFromPost();
        try {
            PdoConnect::getInstance()->pdo->beginTransaction();

            $parameter = $this->getFields();
            $parameter += isset(APP_TABLE[static::$table]['app_id']) ? ['app_id' => $this->appId]: [];
            $parameter += isset(APP_TABLE[static::$table]['date_add']) ? ['date_add' => time()] : [];

            $table = Orm::getInstance(static::$table);
            $result = $table->insert($parameter);

            $lang = $this->getFieldsLang();
            if ($lang) {
                $table = Orm::getInstance(static::$table.'_lang');
                foreach ($lang as $langId => $parameter) {
                    $parameter += ['lang_id' => $langId, static::$foreign => $result['lastInsertId']];
                    $table->insert($parameter);
                }
            }

            return PdoConnect::getInstance()->pdo->commit() && $this->afterCreate($result['lastInsertId']) ? $result['lastInsertId']: 0;
        } catch (Throwable $e) {
            PdoConnect::getInstance()->pdo->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public static function read(string $table, int $id = 0, int $langId = 0)
    {
        $data = &Cache::static(__METHOD__);
        if (isset($data[$table][$id][$langId])) {
            return $data[$table][$id][$langId];
        }

        if ($langId > 0) {
            $id .= '_'.$langId;
        }

        $key = 'table:'.$table;
        $redis = RedisConnect::getInstance()->redis;
        $data[$table][$id][$langId]  = strpos($id, '0') === 0 ? array_values($redis->hGetAll($key)) : $redis->hGet($key, $id);
        return $data[$table][$id][$langId];
    }

    public function update(): bool
    {
        $this->beforeUpdate();
        $this->copyFromPost();
        try {
            PdoConnect::getInstance()->pdo->beginTransaction();

            $table = Orm::getInstance(static::$table);
            $table->update($this->getFields(), ['id' => $this->id]);

            $lang = $this->getFieldsLang();
            if ($lang) {
                $table = Orm::getInstance(static::$table.'_lang');
                foreach ($lang as $langId => $parameter) {
                    $table->update($parameter, [static::$foreign => $this->id, 'lang_id' => $langId]);
                }
            }

            return PdoConnect::getInstance()->pdo->commit() && $this->afterUpdate();
        } catch (Throwable $e) {
            PdoConnect::getInstance()->pdo->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function delete(): bool
    {
        $this->beforeDelete();
        $table = Orm::getInstance(static::$table);
        return $table->delete(['id' => $this->id]) === 1 && $this->afterDelete();
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
        foreach ($this->langId ? [$this->langId] : LangModel::getIds() as $langId) {
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
        if (!empty($this->fields[$field]['require']) && Validate::isEmpty($value)) {
            return sprintf('The %s field is required.', $field);
        }

        if (!isset($this->fields[$field]['type'])) {
            return sprintf('The %s field type is required.', $field);
        }

        $desc = APP_TABLE[static::$table][$field] ?? APP_TABLE[static::$table.'_lang'][$field];

        if (Validate::isEmpty($value)) {
            $value = $desc['default'];
            $langId ? $this->{$field}[$langId] = $value : $this->$field = $value;
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
                $fields[$field] = $this->formatValue($this->{$field}[$langId], $this->fields[$field]['type']);
            }
        } else {
            foreach ($this->getDefinition(static::$table) as $field) {
                $fields[$field] = $this->formatValue($this->$field, $this->fields[$field]['type']);
            }
            $fields += isset(APP_TABLE[static::$table]['date_upd']) ? ['date_upd' => time()] : [];
        }
        return $fields;
    }

    private function formatValue($value, int $type)
    {
        switch ($type) {
            case self::INT:
                return (int) $value;
            case self::BOOL:
                return (int) (bool) $value;
            case self::FLOAT:
                return (float) $value;
            case self::DATE:
                return strtotime(Tools::dateFormat($value));
            case self::NOTHING:
                return $value;
            case self::HTML:
            default:
                return Tools::safeOutPut($value);
        }
    }

    protected function copyFromPost()
    {
        foreach ($this->getDefinition(static::$table) as $field) {
            $this->{$field} = $_GET[$field] ?? null;
        }

        foreach ($this->getDefinition(static::$table.'_lang') as $field) {
            foreach ($this->langId ? [$this->langId] : LangModel::getIds() as $langId) {
                $this->{$field}[$langId] = $_GET[$field.'_'.$langId] ?? null;
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

    protected function beforeCreate(): bool
    {
        return true;
    }

    protected function afterCreate(int $id): bool
    {
        $table = Orm::getInstance(static::$table);
        $redis = RedisConnect::getInstance()->redis;
        $redis->hSet(
            'table:'.static::$table,
            $this->id,
            $table->select(['*'])->where(['id' => $this->id])->fetch()
        );

        if (isset(APP_TABLE[static::$table.'_lang'])) {
            $redis->hSet(
                'table:'.static::$table.'_lang',
                $this->id.'_'.$this->langId,
                $table->select(['*'])->where(['id' => $this->id, 'lang_id' => $this->langId])->fetch()
            );
        }
        return true;
    }

    protected function beforeUpdate(): bool
    {
        return true;
    }

    protected function afterUpdate(): bool
    {
        return $this->afterCreate($this->id);
    }

    protected function beforeDelete(): bool
    {
        return true;
    }

    protected function afterDelete(): bool
    {
        $redis = RedisConnect::getInstance()->redis;
        $redis->hDel('table:'.static::$table, $this->id);

        if (isset(APP_TABLE[static::$table.'_lang'])) {
            foreach (LangModel::getIds() as $langId) {
                $redis->hDel('table:'.static::$table.'_lang', $this->id.'_'.$langId);
            }
        }
        return true;
    }
}

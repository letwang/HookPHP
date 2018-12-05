<?php
use Hook\Db\{PdoConnect,RedisConnect,Table};
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
        $this->copyFromPost();
        try {
            PdoConnect::getInstance()->pdo->beginTransaction();

            $data = $this->getFields();
            $data += isset(APP_TABLE[static::$table]['app_id']) ? ['app_id' => $this->appId]: [];
            $data += isset(APP_TABLE[static::$table]['date_add']) ? ['date_add' => time()] : [];
            $result = PdoConnect::getInstance()->insert(
                'INSERT INTO `'.static::$table.'`(`'.join('`,`', array_keys($data)).'`)VALUES(:'.join(',:', array_keys($data)).');',
                $data
            );

            foreach ($this->getFieldsLang() as $langId => $data) {
                $data += ['lang_id' => $langId, static::$foreign => $result['lastInsertId']];
                PdoConnect::getInstance()->insert(
                    'INSERT INTO `'.static::$table.'_lang`(`'.join('`,`', array_keys($data)).'`)VALUES(:'.join(',:', array_keys($data)).');',
                    $data
                );
            }
            return PdoConnect::getInstance()->pdo->commit() ? $result['lastInsertId']: 0;
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
        $this->copyFromPost();
        try {
            PdoConnect::getInstance()->pdo->beginTransaction();

            $keys = '';
            foreach ($this->getFields() as $key => $value) {
                $keys .= '`'.$key.'`=:'.$key.',';
            }
            PdoConnect::getInstance()->update(
                'UPDATE `'.static::$table.'` SET '.substr($keys, 0, -1).' WHERE `id`='.$this->id,
                $this->getFields()
            );

            foreach ($this->getFieldsLang() as $langId => $data) {
                static $keys = '';
                if ($keys === '') {
                    foreach ($data as $key => $value) {
                        $keys .= '`'.$key.'`=:'.$key.',';
                    }
                }
                PdoConnect::getInstance()->update(
                    'UPDATE `'.static::$table.'_lang` SET '.substr($keys, 0, -1).' WHERE `'.static::$foreign.'`='.$this->id.' AND `lang_id`='.$langId,
                    $data
                );
            }

            return PdoConnect::getInstance()->pdo->commit();
        } catch (Throwable $e) {
            PdoConnect::getInstance()->pdo->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function delete(): bool
    {
        $data = PdoConnect::getInstance()->delete('DELETE FROM `'.static::$table.'` WHERE `id`=?', [$this->id]) === 1;
        return $data && $this->afterDelete();
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

    protected function afterDelete(): bool
    {
        $redis = RedisConnect::getInstance()->redis;
        $redis->hDel('table:'.static::$table, $this->id);
        foreach (LangModel::getIds() as $langId) {
            $redis->hDel('table:'.static::$table.'_lang', $this->id.'_'.$langId);
        }
        return true;
    }
}

<?php
use Hook\Db\{PdoConnect,RedisConnect,Table};
use Hook\Cache\Cache;
use Hook\Validate\Validate;

abstract class AbstractModel
{
    public $table;
    public $foreign;

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
        $this->langId = $langId ?? 1;

        $this->ignore = ['id' => true, 'app_id' => true, $this->foreign => true, 'lang_id' => true];
    }

    public function create(): int
    {
        $this->copyFromPost();
        try {
            PdoConnect::getInstance()->pdo->beginTransaction();

            $keys = array_keys($this->getFields());
            $result = PdoConnect::getInstance()->insert(
                'INSERT INTO `'.$this->table.'`(`'.join('`,`', $keys).'`)VALUES(:'.join(',:', $keys).');',
                $this->getFields()
            );

            if ($this->foreign) {
                foreach ($this->getFieldsLang() as $langId => $lang) {
                    $lang[$this->foreign] = $result['lastInsertId'];
                    $keys = array_keys($lang);
                    PdoConnect::getInstance()->insert(
                        'INSERT INTO `'.$this->table.'_lang`(`'.join('`,`', $keys).'`)VALUES(:'.join(',:', $keys).');',
                        $lang
                    );
                }
            }
            return PdoConnect::getInstance()->pdo->commit() ? $result['lastInsertId']: 0;
        } catch (Throwable $e) {
            PdoConnect::getInstance()->pdo->rollBack();
            throw new Exception($e->getMessage());
        }
        return 0;
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
            $this->ignore += ['date_add' => true];

            $keys = '';
            foreach ($this->getFields() as $key => $value) {
                $keys .= '`'.$key.'`=:'.$key.',';
            }
            PdoConnect::getInstance()->update(
                'UPDATE `'.$this->table.'` SET '.substr($keys, 0, -1).' WHERE `id`='.$this->id,
                $this->getFields()
            );

            if ($this->foreign) {
                foreach ($this->getFieldsLang() as $langId => $lang) {
                    unset($lang['lang_id']);
                    static $keys = '';
                    if ($keys === '') {
                        foreach ($lang as $key => $value) {
                            $keys .= '`'.$key.'`=:'.$key.',';
                        }
                    }
                    PdoConnect::getInstance()->update(
                        'UPDATE `'.$this->table.'_lang` SET '.substr($keys, 0, -1).' WHERE `'.$this->foreign.'`='.$this->id.' AND `lang_id`='.$this->langId,
                        $lang
                    );
                }
            }

            return PdoConnect::getInstance()->pdo->commit();
        } catch (Throwable $e) {
            PdoConnect::getInstance()->pdo->rollBack();
            throw new Exception($e->getMessage());
        }
        return false;
    }

    public function delete(): bool
    {
        return PdoConnect::getInstance()->delete('DELETE FROM `'.$this->table.'` WHERE `id`=?', [$this->id]) === 1;
    }

    private function getFields(): array
    {
        $this->validateFields();
        $fields['app_id'] = $this->appId;
        $fields += $this->formatFields();
        return $fields;
    }

    private function getFieldsLang(): array
    {
        $this->validateFieldsLang();
        $fields = [];
        if ($this->langId) {
            $fields = [$this->langId => $this->formatFields($this->langId)];
            $fields[$this->langId]['lang_id'] = $this->langId;
        } else {
            foreach ([1] as $langId) {
                $fields[$langId] = $this->formatFields($langId);
                $fields[$langId]['lang_id'] = $langId;
            }
        }
        return $fields;
    }

    private function validateFields($exit = true, $return = false)
    {
        foreach ($this->getDefinition($this->table) as $field) {
            $message = $this->validateField($field, $this->{$field});
            if ($message !== true) {
                if ($exit) {
                    throw new \Exception($message);
                }
                return $return ? $message : false;
            }
        }
        return true;
    }

    private function validateFieldsLang($exit = true, $return = false)
    {
        foreach ($this->getDefinition($this->table.'_lang') as $field) {
            $values = $this->$field;
            foreach ($values as $langId => $value) {
                $message = $this->validateField($field, $value, $langId);
                if ($message !== true) {
                    if ($exit) {
                        throw new \Exception($message);
                    }
                    return $return ? $message : false;
                }
            }
        }
        return true;
    }

    private function validateField($field, $value, $langId = null)
    {
        if (!empty($this->fields[$field]['require']) && Validate::isEmpty($value)) {
            return sprintf('The %s field is required.', $field);
        }

        $desc = APP_TABLE[$this->table][$field] ?? APP_TABLE[$this->table.'_lang'][$field];

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
        if (!call_user_func(['Hook\Validate\Validate', $this->fields[$field]['validate']], $value)) {
            return sprintf('The %s field is invalid.', $field);
        }
        return true;
    }

    private function formatFields(int $langId = null): array
    {
        $fields = [];
        if ($langId) {
            foreach ($this->getDefinition($this->table.'_lang') as $field) {
                $fields[$field] = $this->formatValue($this->{$field}[$langId] ?? '', $this->fields[$field]['type']);
            }
        } else {
            foreach ($this->getDefinition($this->table) as $field) {
                $fields[$field] = $this->formatValue($this->$field ?? '', $this->fields[$field]['type']);
            }
        }
        return $fields;
    }

    private function formatValue($value, $type)
    {
        switch ($type) {
            case self::INT:
                return (int) $value;
            case self::BOOL:
                return (bool) $value;
            case self::FLOAT:
                return (float) str_replace(',', '.', $value);
            case self::DATE:
                return $value ? $value : '0000-00-00';
            case self::NOTHING:
                return $value;
            case self::HTML:
            default:
                return htmlentities($value);;
        }
    }

    private function copyFromPost()
    {
        foreach ($this->getDefinition($this->table) as $field) {
            $this->{$field} = $_GET[$field] ?? '';
        }

        foreach ($this->getDefinition($this->table.'_lang') as $field) {
            foreach ([1] as $langId) {
                $this->{$field}[$langId] = $_GET[$field.'_'.$langId] ?? null;
            }
        }
    }

    private function getDefinition($table)
    {
        return isset(APP_TABLE[$table]) ? array_keys(array_diff_key(APP_TABLE[$table], $this->ignore)) : [];
    }
}

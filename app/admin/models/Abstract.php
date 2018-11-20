<?php
use Hook\Db\{PdoConnect,RedisConnect,Table};
use Hook\Cache\Cache;
use Hook\Tools\Tools;

abstract class AbstractModel
{
    public $table;
    public $foreign;

    public $id;
    public $app_id;
    public $lang_id;

    public $ignoreFields = [];

    const INT = 1;
    const BOOL = 2;
    const FLOAT = 3;
    const DATE = 4;
    const HTML = 5;
    const NOTHING = 6;

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        $this->id = $id;
        $this->app_id = $appId;
        $this->lang_id = $langId;
        $this->ignoreFields = ['id' => true, 'app_id' => true, $this->foreign => true, 'lang_id' => true];
    }

    public static function get(string $table, int $id = 0, int $langId = 0): array
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

    public function create(): int
    {
        try {
            PdoConnect::getInstance()->pdo->beginTransaction();

            $keys = array_keys($this->field[0]);
            $result = PdoConnect::getInstance()->insert(
                'INSERT INTO `'.$this->table.'`(`'.join('`,`', $keys).'`)VALUES(:'.join(',:', $keys).');',
                $this->field[0]
            );

            $keys = array_keys($this->field[1]);
            PdoConnect::getInstance()->insert(
                'INSERT INTO `'.$this->table.'_lang`(`'.join('`,`', $keys).'`)VALUES(:'.join(',:', $keys).');',
                [$this->foreign => $result['lastInsertId']] + $this->field[1]
            );

            return PdoConnect::getInstance()->pdo->commit() ? $result['lastInsertId']: 0;
        } catch (Exception $e) {
            PdoConnect::getInstance()->pdo->rollBack();
            throw new Exception($e->getMessage());
        }
        return 0;
    }

    public function update(int $id): bool
    {
        try {
            PdoConnect::getInstance()->pdo->beginTransaction();

            unset($this->field[0]['id']);
            $keys = '';
            foreach ($this->field[0] as $key => $value) {
                $keys .= '`'.$key.'`=:'.$key.',';
            }
            PdoConnect::getInstance()->update(
                'UPDATE `'.$this->table.'` SET '.substr($keys, 0, -1).' WHERE `id`='.$id,
                $this->field[0]
            );

            $langId = $this->field[1]['lang_id'];
            unset($this->field[1]['id'], $this->field[1]['lang_id'], $this->field[1][$this->foreign]);
            $keys = '';
            foreach ($this->field[1] as $key => $value) {
                $keys .= '`'.$key.'`=:'.$key.',';
            }
            PdoConnect::getInstance()->update(
                'UPDATE `'.$this->table.'_lang` SET '.substr($keys, 0, -1).' WHERE `'.$this->foreign.'`='.$id.' AND `lang_id`='.$langId,
                $this->field[1]
            );

            return PdoConnect::getInstance()->pdo->commit();
        } catch (Exception $e) {
            PdoConnect::getInstance()->pdo->rollBack();
            throw new Exception($e->getMessage());
        }
        return false;
    }

    public function delete(int $id): int
    {
        return PdoConnect::getInstance()->delete('DELETE FROM `'.$this->table.'` WHERE `id`=?', [$id]);
    }

    public function getFields(): array
    {
        $this->validateFields();
        $fields['app_id'] = $this->app_id;
        $fields += $this->formatFields();
        return $fields;
    }

    public function getFieldsLang(): array
    {
        $this->validateFieldsLang();
        $fields = [];
        if ($this->lang_id) {
            $fields = array($this->lang_id => $this->formatFields($this->lang_id));
            $fields[$this->lang_id]['lang_id'] = $this->lang_id;
        } else {
            foreach ([1] as $langId) {
                $fields[$langId] = $this->formatFields($langId);
                $fields[$langId]['lang_id'] = $langId;
            }
        }
        return $fields;
    }

    public function validateFields($exit = true, $return = false)
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

    public function validateFieldsLang($exit = true, $return = false)
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

    public function validateField($field, $value, $langId = null)
    {
        if (!empty($this->fields[$field]['require']) && Tools::isEmpty($value)) {
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
        if (!call_user_func(array('Hook\Validate\Validate', $this->fields[$field]['validate']), $value)) {
            return sprintf('The %s field is invalid.', $field);
        }
        return true;
    }

    public function formatFields(int $langId = null): array
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

    public function formatValue($value, $type)
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

    public function copyFromPost(&$object)
    {
        foreach ($this->getDefinition($this->table) as $field) {
            $object->{$field} = $_POST[$field] ?? '';
        }

        foreach ($this->getDefinition($this->table.'_lang') as $field) {
            foreach ([1] as $langId) {
                $object->{$field}[$langId] = $_POST[$field.'_'.$langId] ?? null;
            }
        }
    }

    public function getDefinition($table)
    {
        return array_keys(array_diff_key(APP_TABLE[$table], $this->ignoreFields));
    }
}

<?php
namespace Base;

use Yaconf;
use LangModel;
use Hook\Db\{OrmConnect, PdoConnect, YacConnect};
use Hook\Cache\Cache;
use Hook\Validate\Validate;
use Hook\Tools\Tools;

abstract class AbstractModel extends Cache
{
    public $table;
    public $foreign;

    public $id;

    public $fields = [];
    public $ignore = ['id' => true, 'date_add' => true, 'date_upd' => true, 'lang_id' => true];

    private $tableLang;
    private $definition;
    private $definitionLang;

    const INT = 1;
    const BOOL = 2;
    const FLOAT = 3;
    const DATE = 4;
    const NOTHING = 6;

    public function __construct($id = null)
    {
        $this->id = (int) $id;
        $this->table = Tools::formatTableName('%p'.($this->table ?? '%s_'.strtolower(str_replace(['\\', 'Model'], ['_', ''], get_called_class()))));
        $this->foreign = $this->foreign ?? substr(strrchr($this->table, '_'), 1).'_id';
        $this->ignore += $this->foreign ? [$this->foreign => true] : [];
        $this->definition = array_keys(array_diff_key(APP_TABLE[$this->table], $this->ignore));
        if (isset(APP_TABLE[$this->table.'_lang'])) {
            $this->tableLang = $this->table.'_lang';
            $this->definitionLang = array_keys(array_diff_key(APP_TABLE[$this->tableLang], $this->ignore));
        }
    }

    public function getData(int $langId = null)
    {
        $key = sprintf(Yaconf::get('const')['table']['meta'], $langId ? $this->tableLang : $this->table);
        $callback = function(\Redis $redis) use ($key) {
            return $redis->hGetAll($key);
        };

        return YacConnect::getInstance()->get($key, $callback, $this->id.($langId ? '_'.$langId : ''));
    }

    public function post(): int
    {
        $this->beforePost();
        $this->copyFromPost();
        try {
            PdoConnect::getInstance()->handle->beginTransaction();

            $parameter = $this->getFields();
            $parameter += isset(APP_TABLE[$this->table]['date_add']) ? ['date_add' => time()] : [];

            $result = OrmConnect::getInstance($this->table)->insert($parameter);

            if ($this->tableLang) {
                $orm = OrmConnect::getInstance($this->tableLang);
                foreach ($this->getFieldsLang() as $langId => $parameter) {
                    $parameter += ['lang_id' => $langId, $this->foreign => $result['lastInsertId']];
                    $orm->insert($parameter);
                }
            }

            return PdoConnect::getInstance()->handle->commit() && $this->afterPost($result['lastInsertId']) ? $result['lastInsertId']: 0;
        } catch (\Throwable $e) {
            PdoConnect::getInstance()->handle->rollBack();
            AbstractController::send([], 100003, $e->getMessage(), 500);
        }
    }

    public function delete(): bool
    {
        $this->beforeDelete();
        try {
            PdoConnect::getInstance()->handle->beginTransaction();

            OrmConnect::getInstance($this->table)->where(['id' => $this->id])->delete();

            return PdoConnect::getInstance()->handle->commit() && $this->afterDelete();
        } catch (\Throwable $e) {
            PdoConnect::getInstance()->handle->rollBack();
            AbstractController::send([], 100005, $e->getMessage(), 500);
        }
    }

    public function put(): bool
    {
        $this->beforePut();
        $this->copyFromPost();
        try {
            PdoConnect::getInstance()->handle->beginTransaction();

            OrmConnect::getInstance($this->table)->where(['id' => $this->id])->update($this->getFields());

            if ($this->tableLang) {
                $orm = OrmConnect::getInstance($this->tableLang);
                foreach ($this->getFieldsLang() as $langId => $parameter) {
                    $orm->where([$this->foreign => $this->id, 'lang_id' => $langId])->update($parameter);
                }
            }

            return PdoConnect::getInstance()->handle->commit() && $this->afterPut();
        } catch (\Throwable $e) {
            PdoConnect::getInstance()->handle->rollBack();
            AbstractController::send([], 100004, $e->getMessage(), 500);
        }
    }

    public function get()
    {
        return array_values($this->getData());
    }

    private function getFields(): array
    {
        $this->validateFields();
        $fields = $this->formatFields();
        return $fields;
    }

    private function getFieldsLang(): array
    {
        $this->validateFieldsLang();
        $fields = [];
        foreach (LangModel::getInstance()->getIds() as $langId) {
            $fields[$langId] = $this->formatFields($langId);
        }
        return $fields;
    }

    private function validateFields(bool $exit = true, bool $return = false)
    {
        foreach ($this->definition as $field) {
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
        foreach ($this->definitionLang as $field) {
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
        $desc = APP_TABLE[$this->table][$field] ?? APP_TABLE[$this->tableLang][$field];

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
            foreach ($this->definitionLang as $field) {
                $fields[$field] = $this->formatValue($this->{$field}[$langId], $this->fields[$field]['type'] ?? null);
            }
        } else {
            foreach ($this->definition as $field) {
                $fields[$field] = $this->formatValue($this->$field, $this->fields[$field]['type'] ?? null);
            }
            $fields += isset(APP_TABLE[$this->table]['date_upd']) ? ['date_upd' => time()] : [];
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
        foreach ($this->definition as $field) {
            $this->{$field} = $_POST[$field] ?? null;
        }

        foreach ($this->definitionLang as $field) {
            foreach (LangModel::getInstance()->getIds() as $langId) {
                $this->{$field}[$langId] = $_POST[$field.'_'.$langId] ?? null;
            }
        }
    }

    protected function beforePost(): bool
    {
        return true;
    }

    protected function afterPost(int $id): bool
    {
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
        return true;
    }
}

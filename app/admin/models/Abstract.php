<?php
use Hook\Db\{PdoConnect,Table};

abstract class AbstractModel
{
    public $table = '';
    public $foreign = '';

    public $field = [[], []];
    public $validate = [];

    public function __construct()
    {
        $this->field[0] = ['id' => NULL, 'date_add' => time(), 'date_upd' => time()];
        $this->field[1] = $this->field[0] + ['lang_id' => $_SESSION[APP_NAME]['lang_id'], $this->foreign => 0];
        foreach ($this->validate as $field => $filter) {
            $result = filter_input($filter['type'], $field, $filter['filter'], $filter['options']);
            if ($result === false || $result === null) {
                throw new \InvalidArgumentException(l(get_called_class().'.'.$field.'.validate.error'));
            }

            $this->field[isset($filter['lang'])][$field] = $result;
        }
    }

    public function add(): int
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

    public static function delete(int $id): int
    {
        return PdoConnect::getInstance()->delete('DELETE FROM `'.$this->table.'` WHERE `id`=?', [$id]);
    }
}

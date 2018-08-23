<?php
use Hook\Db\{PdoConnect,Table};
use Yaf\Session;

class ObjectModel
{
    public $table = '';
    public $foreign = '';
    public $validate = [];

    public $langId = 0;
    public $field = [[], []];

    public function __construct()
    {
        $this->langId = Session::getInstance()->get('user')['lang_id'];
        $this->field = [
            ['id' => NULL, 'date_add' => time(), 'date_upd' => time()],
            ['id' => NULL, 'date_add' => time(), 'date_upd' => time(), 'lang_id' => $this->langId, $this->foreign => 0]
        ];
        foreach ($this->validate as $field => $filter) {
            $result = filter_input($filter['type'], $field, $filter['filter'], $filter['options']);
            if ($result === false || $result === null) {
                throw new \InvalidArgumentException('Field '.$field.' '.($filter['error'] ?? 'error.'));
            }

            $this->field[isset($filter['lang'])][$field] = $result;
        }
    }

    public function add(): int
    {
        try {
            PdoConnect::getInstance()->pdo->beginTransaction();

            //主表
            $keys = array_keys($this->field[0]);
            $result = PdoConnect::getInstance()->insert(
                'INSERT INTO `'.$this->table.'`(`'.join('`,`', $keys).'`)VALUES(:'.join(',:', $keys).');',
                $this->field[0]
            );

            //语言表
            $keys = array_keys($this->field[1]);
            $this->field[1][$this->foreign] = $result['lastInsertId'];
            PdoConnect::getInstance()->insert(
                'INSERT INTO `'.$this->table.'_lang`(`'.join('`,`', $keys).'`)VALUES(:'.join(',:', $keys).');',
                $this->field[1]
            );

            PdoConnect::getInstance()->pdo->commit();
            return (int) $result['lastInsertId'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            PdoConnect::getInstance()->pdo->rollBack();
        }
        return 0;
    }

    public function update(int $id): bool
    {
        try {
            PdoConnect::getInstance()->pdo->beginTransaction();

            //主表
            unset($this->field[0]['id']);
            $keys = '';
            foreach ($this->field[0] as $key => $value) {
                $keys .= '`'.$key.'`=:'.$key.',';
            }
            $rowCount = PdoConnect::getInstance()->update(
                'UPDATE `'.$this->table.'` SET '.substr($keys, 0, -1).' WHERE `id`='.$id,
                $this->field[0]
            );

            //语言表
            unset($this->field[1]['id'], $this->field[1]['lang_id'], $this->field[1][$this->foreign]);
            $keys = '';
            foreach ($this->field[1] as $key => $value) {
                $keys .= '`'.$key.'`=:'.$key.',';
            }
            PdoConnect::getInstance()->update(
                'UPDATE `'.$this->table.'_lang` SET '.substr($keys, 0, -1).' WHERE `'.$this->foreign.'`='.$id.' AND `lang_id`='.$this->langId,
                $this->field[1]
            );

            PdoConnect::getInstance()->pdo->commit();
            return $rowCount > 0;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            PdoConnect::getInstance()->pdo->rollBack();
        }
        return false;
    }

    public function delete(int $id): bool
    {
        return PdoConnect::getInstance()->delete('DELETE FROM `'.$this->table.'` WHERE `id`=?', [$id]) > 0;
    }
}

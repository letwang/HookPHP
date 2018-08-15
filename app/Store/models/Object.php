<?php
use Hook\Db\PdoConnect;
use Hook\Db\Table;

class ObjectModel
{
    public $fields = [];
    public $fieldsLang = [];
    public $definition = [];

    public function __construct()
    {
        foreach ($this->definition['fields'] as $field => $filter) {
            $result = filter_input($filter['type'], $field, $filter['filter'], $filter['options']);
            if (!$result) {
                throw new \InvalidArgumentException('Field '.$field.' '.($filter['error'] ?? 'error.'));
            }
            $this->fields[$field] = $result;
        }

        foreach ($this->definition['fieldsLang'] as $field => $filter) {
            $result = filter_input($filter['type'], $field, $filter['filter'], $filter['options']);
            if (!$result) {
                throw new \InvalidArgumentException('Field '.$field.' '.($filter['error'] ?? 'error.'));
            }
            $this->fieldsLang[$field] = $result;
        }
    }

    public function add()
    {
        $table = new Table($this->definition['table']);
        $field = array_keys($table->desc());

        $param = [
            ':id' => NULL,
            ':date_add' => time(),
            ':date_upd' => time(),
        ];
        foreach ($this->fields as $key => $value) {
            $param[':'.$key] = $value;
        }

        $resource = PdoConnect::getInstance()->insert(
            'INSERT INTO `'.$this->definition['table'].'` (`'.join('`,`', $field).'`) VALUES (:'.join(',:', $field).');',
            $param
        );
        if ($resource['lastInsertId'] <= 0) {
            return false;
        }

        $table = new Table($this->definition['table'].'_lang');
        $field = array_keys($table->desc());

        $param = [
            ':id' => NULL,
            ':lang_id' => 1,
            ':resource_id' => $resource['lastInsertId'],
            ':date_add' => time(),
            ':date_upd' => time(),
        ];
        foreach ($this->fieldsLang as $key => $value) {
            $param[':'.$key] = $value;
        }
        $result = PdoConnect::getInstance()->insert(
            'INSERT INTO `'.$this->definition['table'].'_lang`(`'.join('`,`', $field).'`) VALUES (:'.join(',:', $field).');',
            $param
        );
        return $result;
    }

    public function update()
    {
        //
    }

    public function delete()
    {
        //
    }
}
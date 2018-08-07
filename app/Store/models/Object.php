<?php
class ObjectModel
{
    public $result = [];
    public $definition = [];

    public function __construct()
    {
        foreach ($this->definition['fields'] as $field => $filter) {
            $result = filter_input($filter['type'], $field, $filter['filter'], $filter['options']);
            if (!$result) {
                throw new \InvalidArgumentException('Field '.$field.' '.($filter['error'] ?? 'error.'));
            }
            $this->result[$field] = $result;
        }
    }
}
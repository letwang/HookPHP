<?php
declare(strict_types=1);

namespace Hook\Data;

class ArrayUtils
{

    public string $idKey = '';

    public string $parentIdKey = '';

    public function classify($array, $parent_id = 0)
    {
        $childs = $this->findChild($array, $parent_id);
        if (empty($childs)) {
            return null;
        }
        foreach ($childs as $k => $v) {
            $rescurTree = $this->classify($array, $v[$this->idKey]);
            if (null != $rescurTree) {
                $childs[$k]['childs'] = $rescurTree;
            }
        }
        return $childs;
    }

    private function findChild(&$array, $id)
    {
        $childs = [];
        foreach ($array as $v) {
            if ($v[$this->parentIdKey] == $id) {
                $childs[] = $v;
            }
        }
        return $childs;
    }
}
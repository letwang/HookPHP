<?php
class ThemeModel extends AbstractModel
{
    public static $table = 'hp_theme';

    public function __construct(int $id = null)
    {
        parent::__construct($id);
    }
}
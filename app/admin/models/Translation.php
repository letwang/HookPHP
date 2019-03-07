<?php
class TranslationModel extends AbstractModel
{
    public static $table = 'hp_translation';

    public function __construct(int $id = null)
    {
        parent::__construct($id);
    }
}
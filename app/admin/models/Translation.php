<?php
class TranslationModel extends AbstractModel
{
    public static $table = 'hp_translation';

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }
}
<?php
declare(strict_types=1);

namespace Hook;

class HookModel extends \Base\AbstractModel
{
    public array $fields = [
        'position' => ['type' => parent::INT, 'required' => true, 'validate' => 'isInt'],
        'key' => ['required' => true, 'validate' => 'isGenericName'],
        'name' => ['required' => true, 'validate' => 'isGenericName'],
        'title' => ['required' => true, 'validate' => 'isGenericName'],
        'description' => ['type' => parent::HTML],
    ];

    public function get(): array
    {
        return $this->orm->queryAll(apcu_fetch('global')['sql']['HOOK']['HOOK']['GET_ALL'], [APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        return $this->orm->queryAll(apcu_fetch('global')['sql']['HOOK']['HOOK']['GET_SELECT'], [APP_LANG_ID], \PDO::FETCH_KEY_PAIR);
    }
}
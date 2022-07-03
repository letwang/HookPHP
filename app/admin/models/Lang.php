<?php
declare(strict_types=1);

use Hook\Db\OrmConnect;

class LangModel extends Base\AbstractModel
{
    public string $table = 'admin_lang_i18n';
    public array $fields = [
        'name' => ['validate' => 'isBool'],
        'status' => ['type' => parent::BOOL, 'validate' => 'isGenericName'],
        'iso_code' => ['required' => true, 'validate' => 'isIsoCode'],
        'language_code' => ['required' => true, 'validate' => 'isGenericName'],
        'locale' => ['required' => true, 'validate' => 'isGenericName'],
        'date_format_lite' => ['required' => true, 'validate' => 'isGenericName'],
        'date_format_full' => ['required' => true, 'validate' => 'isGenericName'],
        'is_rtl' => ['required' => true, 'validate' => 'isGenericName'],
    ];

    public function getIds(): array
    {
        return OrmConnect::getInstance($this->table)->select(['locale', 'id'])->where(['status' => 1])->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function getDefaultId(string $name = null): int
    {
        $data = $this->getIds();
        return $data[$name] ?? $_SESSION[APP_NAME]['lang_id'] ?? $data[APP_LANG_NAME];
    }

    public function getDefaultName(int $id = null): string
    {
        $data = array_flip($this->getIds());
        return $data[$id] ?? $data[APP_LANG_ID];
    }
}
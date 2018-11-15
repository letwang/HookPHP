<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl;

class ResourceModel extends \AbstractModel
{
    public $table = 'hp_acl_resource';
    public $foreign = 'resource_id';

    public function __construct()
    {
        /*$this->validate = [
            'app' => [
                'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['options' => ['regexp' => '/^[[:alpha:]]{'.APP_TABLE[$this->table]['app']['min'].','.APP_TABLE[$this->table]['app']['max'].'}$/']]
            ],
            'module' => [
                'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['options' => ['regexp' => '/^[[:alpha:]]{'.APP_TABLE[$this->table]['module']['min'].','.APP_TABLE[$this->table]['module']['max'].'}$/']]
            ],
            'controller' => [
                'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['options' => ['regexp' => '/^[[:alpha:]]{'.APP_TABLE[$this->table]['controller']['min'].','.APP_TABLE[$this->table]['controller']['max'].'}$/']]
            ],
            'action' => [
                'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['options' => ['regexp' => '/^[[:alpha:]]{'.APP_TABLE[$this->table]['action']['min'].','.APP_TABLE[$this->table]['action']['max'].'}$/']]
            ],
            'status' => [
                'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_INT,
                'options' => ['options' => ['min_range' => APP_TABLE[$this->table]['status']['min'], 'max_range' => 1]]
            ],
            'name' => [
                'type' => INPUT_POST, 'filter' => FILTER_VALIDATE_REGEXP, 'lang' => true,
                'options' => ['options' => ['regexp' => '/^[[:alpha:]]{'.APP_TABLE[$this->table.'_lang']['name']['min'].','.APP_TABLE[$this->table.'_lang']['name']['max'].'}$/u']]
            ]
        ];*/
        parent::__construct();
    }

    public static function read(string $table, int $id = 0): array
    {
        return PdoConnect::getInstance()->fetchAll(Acl::GET_RESOURCE, [$_SESSION[APP_NAME]['lang_id'], 1]);
    }

    public function create(): int
    {
        return parent::create();
    }

    public function update(int $id): bool
    {
        return parent::update($id);
    }

    public function delete(int $id): int
    {
        return parent::delete($id);
    }
}
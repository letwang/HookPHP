<?php
class TranslationController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->fieldsList = [
            'id' => ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false],
            'id_lang_from' => ['data' => 'id_lang_from', 'className' => 'align-middle', 'title' => l('Translation.id_lang_from')],
            'id_lang_to' => ['data' => 'id_lang_to', 'className' => 'align-middle', 'title' => l('Translation.id_lang_to')],
            'key_crc32' => ['data' => 'key_crc32', 'className' => 'align-middle', 'title' => l('Translation.key_crc32')],
            'key' => ['data' => 'key', 'className' => 'align-middle', 'title' => l('Translation.key')],
            'data' => ['data' => 'data', 'className' => 'align-middle', 'title' => l('Translation.data')],
            'idx' => ['data' => 'id', 'className' => 'align-middle text-right', 'orderable' => false, 'searchable' => false]
        ];
    }

    public function indexAction()
    {
        $this->_view->assign(['fieldsList' => $this->fieldsList]);
    }

    public function addAction()
    {
        //
    }

    public function editAction()
    {
        $this->_view->assign(['id' => (int) $this->getRequest()->getParam('id')]);
    }
}
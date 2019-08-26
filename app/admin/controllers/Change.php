<?php
use Hook\Http\Header;
use Base\AbstractModel;

class ChangeController extends Base\ApiController
{
    public function getAction()
    {
        $appId = $this->getRequest()->getQuery('app_id', 1);
        $langId = $this->getRequest()->getQuery('lang_id', 1);
        if (AppModel::getInstance($appId)->getData() && LangModel::getInstance($langId)->getData()) {
            $_SESSION[APP_NAME]['app_id'] = $appId;
            $_SESSION[APP_NAME]['lang_id'] = $langId;
            Header::redirect($this->getRequest()->getServer('HTTP_REFERER'));
            return true;
        }
        return false;
    }
}
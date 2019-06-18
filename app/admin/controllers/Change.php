<?php
use Hook\Http\Header;
use Base\AbstractModel;

class ChangeController extends Base\ApiController
{
    public function getAction()
    {
        $appId = $this->getRequest()->getQuery('app_id', 1);
        $langId = $this->getRequest()->getQuery('lang_id', 1);
        if (AbstractModel::getData('%padmin_app', $appId) && AbstractModel::getData('%padmin_lang_i18n', $langId)) {
            $_SESSION[APP_NAME]['app_id'] = $appId;
            $_SESSION[APP_NAME]['lang_id'] = $langId;
            Header::redirect($this->getRequest()->getServer('HTTP_REFERER'));
            return true;
        }
        return false;
    }
}
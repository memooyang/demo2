<?php
declare (strict_types = 1);

namespace app;

/**

 */
class BaseIndexController extends BaseClientStageController
{
    protected function initialize()
    {
        parent::initialize();
        $web = \Web::data();
        $mode = \Env::get('WEB_MODE', $web['mode']);
        // $is = \Env::get('WEB_IS_MAINTANCE_CLIENT_STAGE', $web['is_maintance_client_stage']);
        $is = $web['is_maintance_client_stage'];
        // if($is && ($mode == 'prod')){
        if($is){
            $this->nav('/Index/Maintance/index');
        }
    }

    /*
    檢查用戶登入權限
    */
    public function checkAuth()
    {
        $user = \Web::user();
        if(empty($user)){
            $this->nav('/');
        }
    }

}

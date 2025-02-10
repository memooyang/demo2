<?php
declare (strict_types = 1);

namespace app;

/**

 */
class BaseAdminStageController extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        // \Web::logout();
        $web_id = \Env::get('WEB_ID');
        $this->web = \Web::initById($web_id, true);
        // _j($this->web);
    }

    public function logException($e, $params = [])
    {
        $web_id = \Web::id();
        $user = \Web::admin();
        $user_id = $user['id']??0;
        $code = $e->getCode();
        $message = $e->getMessage();
        $memo = $params['memo']??'';
        $rdb = new \Rdb\LogAdminStageException();
        $dataset = array();
        $dataset['web_id'] = $web_id;
        $dataset['user_id'] = $user_id;
        $dataset['code'] = $code;
        $dataset['message'] = $message;
        $dataset['memo'] = $memo;
        $dataset['module'] = $this->thisModule;
        $dataset['controller'] = $this->thisController;
        $dataset['action'] = $this->thisAction;
        $dataset['params'] = json_encode($this->params);
        $dataset['ip'] = _ip();
        $aff = $rdb->add2($dataset);
    }

}

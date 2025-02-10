<?php
declare (strict_types = 1);

namespace app;

/**

 */
class BaseAdminDashboardController extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $web_id = \Env::get('WEB_ID');
        $this->web = \Web::initById($web_id);
        $this->checkAuth();
        $this->setApiModule('AdminApi');
        $this->setHtmlModule('AdminHtml');
        $this->setModule('AdminDashboard');
    }

    protected function initUser()
    {
        try{
            $this->user = \Web::admin();
            // _json($this->user);
            if(empty($this->user)){ return false; }
            if(empty($this->web)){ return false; }
            // if($this->user['web_id'] != $this->web['id']){ throw new \Exception('clear user'); }
        }catch(\Exception $e){
            \Session\User::_clear();
        }
    }

    /*
    檢查用戶登入權限
    */
    public function checkAuth()
    {
        $user = \Web::admin();
        if(empty($user)){
            $this->nav('/AdminStage');
        }
        // _json($user);
        // _json($this->user);
    }

    public function logBeforeUpload($params = [])
    {
        $web_id = \Web::id();
        $user = \Web::admin();
        $user_id = $user['id']??0;
        $role_id = $user['role_id']??0;
        $role_type = $user['role_type']??'';
        $rdb = new \Rdb\LogAdminStageUpload();
        $dataset = array();
        $dataset['role_id'] = $role_id;
        $dataset['role_type'] = $role_type;
        $dataset['web_id'] = $web_id;
        $dataset['user_id'] = $user_id;
        $dataset['role_id'] = $role_id;
        $dataset['role_type'] = $role_type;
        $dataset['callback_params'] = json_encode($this->params);
        $dataset['callback_files'] = json_encode($_FILES);
        $dataset['module'] = $this->thisModule;
        $dataset['controller'] = $this->thisController;
        $dataset['action'] = $this->thisAction;
        $aff = $rdb->add2($dataset);
        $this->log_ids['LogAdminStageUpload'] = $aff;
    }

    public function logAfterUpload($result = [])
    {
        if(array_key_exists('LogAdminStageUpload', $this->log_ids)){
            $rdb = new \Rdb\LogAdminStageUpload();
            $map = array();
            $map['id'] = $this->log_ids['LogAdminStageUpload'];
            $dataset = array();
            $dataset['result'] = json_encode($result);
            $aff = $rdb->where($map)->save($dataset);
        }
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

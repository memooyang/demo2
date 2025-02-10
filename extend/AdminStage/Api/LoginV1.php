<?php
/*
\AdminApi\Index\Api\Login
*/
namespace AdminApi\Index\Api;

class Login extends \AdminApi\Index\Base
{
    public function doProcess()
    {
        //-----
        $account = $this->params['account']??null;
        $password = $this->params['password']??null;
        if(empty($account)){ throw new \Exception('請輸入帳戶'); }
        if(empty($password)){ throw new \Exception('請輸入密碼'); }
        $password_hash = md5($password);
        
        //-----
        $rdb = new \Rdb\AdminUsers();
        $map = [];
        $map['is_internal_account'] = '1';
        $map['is_remove'] = '0';
        $map['is_lock'] = '0';
        $map['account'] = $account;
        $map['password_hash'] = $password_hash;
        $obj = $rdb->where($map)->find();
        
        //-----
        if(empty($obj)){ 
            //-----
            $rdb = new \Rdb\AdminUsers();
            $map = [];
            $map['is_remove'] = '0';
            $map['is_lock'] = '0';
            $map['account'] = $account;
            $map['password_hash'] = $password_hash;
            $obj = $rdb->where($map)->find();
            if(empty($obj)){ throw new \Exception('登入失敗，沒有帳戶資訊'); }
        }
        
        //-----更新使用者資訊
        $browser = new \Browser();
        $dataset = array();
        $dataset['login_at'] = \Date::_();
        $dataset['login_ip'] = \Net::ip();
        $dataset['login_browser'] = $browser->getBrowser();
        $dataset['login_browser_version'] = $browser->getVersion();
        $dataset['login_platform'] = $browser->getPlatform();
        $dataset['http_user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $dataset['session_id'] = session_id();
        $aff = $obj->save($dataset);
        
        //更新本人資訊
        \RdbHandler\AdminUsers\UpdateMySession::doProcess($obj);          
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
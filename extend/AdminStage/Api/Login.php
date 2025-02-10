<?php
/*
\AdminStage\Api\Login
*/
namespace AdminStage\Api;

use think\captcha\facade\Captcha;

class Login extends \AdminStage\Base
{
    /*
    https://www.thinkphp.cn/topic/72666.html
    */
    public function doProcess()
    {
        //-----
        $username = $this->params['username']??null;
        $password = $this->params['password']??null;
        if(empty($username)){ throw new \Exception('請輸入帳戶'); }
        if(empty($password)){ throw new \Exception('請輸入密碼'); }
        
        //-----captcha
        // $captcha_value = $this->params['captcha']??null;
        // if(empty($captcha_value)){ throw new \Exception('請輸入驗證碼'); }
        // if (captcha_check($captcha_value, false)){
        //     throw new \Exception('驗證碼錯誤!');
        // }
        
        //-----ORM
        $rdb = new \Rdb\AdminUsers();
        $map = [];
        $map['status'] = '1';
        $map['username'] = $username;
        // $map['password'] = $password_hash;
        $obj = $rdb->where($map)->find();
        if(empty($obj)){ throw new \Exception('找不到用戶'); }
        $row = $rdb->prepare($obj);
        $validate = \Hash\Bcrypt::validate($password, $row['password']);
        if(empty($validate)){ throw new \Exception('密碼驗證錯誤'); }
        
        //-----存取SESSION
        unset($row['password']);
        \Web::admin($row);
        
        //-----
        $rdb = new \Rdb\AdminUsers();
        $map = \RdbCondition\Web::init();
        $map['id'] = $row['id'];
        $dataset = array();
        $dataset['login_at'] = _date();
        $rdb->where($map)->save($dataset);
        
        //-----存取登入歷程
        $rdb = new \Rdb\AdminUserLoginHistory();
        $rdb->touchHistory($row);
        
        //-----TOKEN
        $payload = [];
        $payload['web_id'] = $row['web_id'];
        $payload['role_id'] = $row['role_id'];
        $payload['id'] = $row['id'];
        $payload['role'] = 'admin';
        $token = \Web\Token::encode($payload);   
        \Session\AdminUsersLoginSuccessToken::_set($token);
        
        //-----輸出結果
        $result = [];
        $result['token'] = $token;
        $this->result = $result;
        return $result;
    }  
}
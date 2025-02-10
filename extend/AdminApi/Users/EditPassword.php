<?php
/*
\AdminApi\Users\EditPassword
*/
namespace AdminApi\Users;

class EditPassword extends \AdminApi\Users\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::admin();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $id = $this->params['id']??'';
        $password_new = $this->params['password_new']??'';
        $password_new_confirm = $this->params['password_new_confirm']??'';
        if(empty($id)){ throw new \Exception('沒有指定用戶'); }
        if(empty($password_new)){ throw new \Exception('請輸入新密碼'); }
        if(empty($password_new_confirm)){ throw new \Exception('請確認新密碼'); }
        if($password_new !== $password_new_confirm){ throw new \Exception('密碼確認時不一致'); }
        
        //-----
        $this->initAndCheck($id);
        
        //-----
        $password_hash_new = \Hash\Bcrypt::make($password_new);
        $dataset = array();
        $dataset['password'] = $password_hash_new;
        $aff = $this->objs['objThis']->save2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
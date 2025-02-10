<?php
/*
\AdminApi\AdminUsers\RenewPassword
*/
namespace AdminApi\AdminUsers;

class RenewPassword extends \AdminApi\AdminUsers\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::admin();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $id = $this->params['id']??'';
        $this->initAndCheck($id);
        
        //-----
        $password_new = uniqid();
        $password_hash_new = \Hash\Bcrypt::make($password_new);
        $dataset = array();
        $dataset['password'] = $password_hash_new;
        $aff = $this->objs['objThis']->save2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['password_new'] = $password_new;
        $this->result = $result;
        return $result;
    }  
}
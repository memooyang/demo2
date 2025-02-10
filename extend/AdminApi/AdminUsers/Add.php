<?php
/*
\AdminApi\AdminUsers\Add
*/
namespace AdminApi\AdminUsers;

class Add extends \AdminApi\AdminUsers\Base
{
    public function doProcess()
    {
        //-----
        $web_id = \Web::id();
        $user = \Web::admin();
        if(empty($web_id)){ throw new \Exception('尚未登入'); }
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $name = $this->params['name']??'';
        $username = $this->params['username']??'';
        // $memo = $this->params['memo']??'';
        if(empty($name)){ throw new \Exception('請輸入用戶名稱'); }
        if(empty($username)){ throw new \Exception('請輸入帳戶'); }
        // if(empty($memo)){ throw new \Exception('請輸入內容'); }
        
        //-----
        $rdb = new \Rdb\AdminUsers();
        $map = \RdbCondition\Web::init();
        $map['username'] = $username;
        $aff = $rdb->where($map)->count();
        if(($aff)){ throw new \Exception('帳戶已存在'); }
        
        //-----
        $dataset = array();
        $dataset['web_id'] = $web_id;
        $dataset['sn'] = uniqid();
        $dataset['name'] = $name;
        $dataset['username'] = $username;
        // $dataset['memo'] = $memo;
        $rdb = new \Rdb\AdminUsers();
        $aff = $rdb->add2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['id'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
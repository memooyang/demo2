<?php
/*
\AdminApi\Posts\Add
*/
namespace AdminApi\Posts;

class Add extends \AdminApi\Posts\Base
{
    public function doProcess()
    {
        //-----
        $web_id = \Web::id();
        $user = \Web::admin();
        if(empty($web_id)){ throw new \Exception('尚未登入'); }
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $title = $this->params['title']??'';
        if(empty($title)){ throw new \Exception('請輸入文字'); }
        
        //-----
        $dataset = array();
        $dataset['web_id'] = $web_id;
        $dataset['sn'] = uniqid();
        $dataset['title'] = $title;
        $rdb = new \Rdb\Posts();
        $aff = $rdb->add2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['id'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
<?php
/*
\AdminApi\Web\Add
*/
namespace AdminApi\Web;

class Add extends \AdminApi\Web\Base
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
        if(empty($name)){ throw new \Exception('請輸入標題'); }
        
        //-----
        $dataset = array();
        $dataset['web_id'] = $web_id;
        $dataset['name'] = $name;
        $rdb = new \Rdb\Web();
        $aff = $rdb->add2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['id'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
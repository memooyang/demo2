<?php
/*
\Api\Core\Lock
*/
namespace Api\Core;

class Lock extends \Api\Base
{
    public function doProcess()
    {
        $web_id = \Web::id();
        $id = $this->params['id']??'';
        $value = $this->params['value']??'0';
        if(empty($id)){ throw new \Exception('沒有指定用戶'); }
        
        //-----
        $dataset = array();
        $dataset['is_lock'] = $value;
        $rdb = $this->rdb;
        $aff = $rdb
        ->where('id', $id)
        ->where('web_id', $web_id)
        ->save($dataset);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
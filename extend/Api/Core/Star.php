<?php
/*
\Api\Core\Star
*/
namespace Api\Core;

class Star extends \Api\Base
{
    public function doProcess()
    {
        $web_id = \Web::id();
        $id = $this->params['id']??'';
        $value = $this->params['value']??'0';
        if(empty($id)){ throw new \Exception('沒有對應ID'); }
        
        //-----
        $dataset = array();
        $dataset['is_star'] = $value;
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
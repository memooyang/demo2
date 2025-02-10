<?php
/*
\Api\Core\Sort
*/
namespace Api\Core;

class Sort extends \Api\Base
{
    public function doProcess()
    {
        $web_id = \Web::id();
        $ids = $this->params['ids']??'';
        if(empty($ids)){ throw new \Exception('沒有指定用戶'); }
        
        //-----
        $sort = 0;
        $rdb = $this->rdb;
        foreach($ids as $id){
            $sort++;
            $dataset = array();
            $dataset['sort'] = $sort;
            $rdb
            ->where('id', $id)
            ->where('web_id', $web_id)
            ->save($dataset);
        }
        
        //-----輸出結果
        $result = [];
        $result['ids'] = $ids;
        $this->result = $result;
        return $result;
    }  
}
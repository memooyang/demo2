<?php
/*
\Api\Core\EditFields
*/
namespace Api\Core;

class EditFields extends \Api\Base
{
    public function doProcess()
    {
        $web_id = \Web::id();
        $id = $this->params['id']??'';
        if(empty($id)){ throw new \Exception('沒有對應的資料'); }
        
        //-----
        $obj = $this->rdb
        ->where('web_id', $web_id)
        ->where('id', $id)
        ->find();
        if(empty($obj)){ throw new \Exception('沒有對應的資料'); }
        $dataset = $this->params;
        $aff = $obj->save2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
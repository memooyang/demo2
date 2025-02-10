<?php
/*
\Api\Core\UpdateBoolean
*/
namespace Api\Core;

class UpdateBoolean extends \Api\Base
{
    // public function init($params = []){
    //     parent::init($params);
    //     // $this->rdb = new \Rdb\XXX();
    // }
    
    public function doProcess()
    {
        $web_id = \Web::id();
        $id = $this->params['id']??'';
        $field = $this->params['field']??'';
        $value = $this->params['value']??'0';
        if(empty($id)){ throw new \Exception('沒有指定用戶'); }
        
        //-----
        $dataset = array();
        $dataset[$field] = $value;
        $aff = $this->rdb
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
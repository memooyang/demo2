<?php
/*
\AdminApi\Web\UpdateBoolean
*/
namespace AdminApi\Web;

class UpdateBoolean extends \Api\Core\UpdateBoolean
{
    public function init($params = []){
        parent::init($params);
        $this->rdb = new \Rdb\Web();
    }
    
    public function doProcess()
    {
        $id = $this->params['id']??'';
        $field = $this->params['field']??'';
        $value = $this->params['value']??'0';
        if(empty($id)){ throw new \Exception('沒有指定用戶'); }
        
        //-----
        $dataset = array();
        $dataset[$field] = $value;
        $aff = $this->rdb
        ->where('id', $id)
        ->save($dataset);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $this->result = $result;
        return $result;
    }  
    
}
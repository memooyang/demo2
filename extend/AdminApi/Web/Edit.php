<?php
/*
\AdminApi\Web\Edit
*/
namespace AdminApi\Web;

class Edit extends \AdminApi\Web\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::admin();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $id = $this->params['id']??'';
        if(empty($id)){ throw new \Exception('沒有對應的資料'); }
        
        //-----
        $this->initAndCheck($id);
        $dataset = $this->params;
        $aff = $this->objs['objThis']->save2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
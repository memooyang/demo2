<?php
/*
\AdminApi\AdminUsers\Edit
*/
namespace AdminApi\AdminUsers;

class Edit extends \AdminApi\AdminUsers\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::admin();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $id = $this->params['id']??'';
        if(empty($id)){ throw new \Exception('沒有對應的資料'); }
        
        // //-----
        // $topic = $this->params['topic']??'';
        // if(empty($topic)){ throw new \Exception('請輸入標題'); }
        
        //-----
        $this->initAndCheck($id);
        $dataset = $this->params;
        unset($dataset['username']);
        unset($dataset['password']);
        // _json($dataset);
        $aff = $this->objs['objThis']->save2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
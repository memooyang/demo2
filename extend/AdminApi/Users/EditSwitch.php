<?php
/*
\AdminApi\Users\EditSwitch
*/
namespace AdminApi\Users;

class EditSwitch extends \AdminApi\Users\Base
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
        // $this->params['is_lock'] = $this->params['is_lock']??'0';
        $this->params['status'] = $this->params['status']??'0';
        $this->params['is_reject_receive_any_notifications'] = $this->params['is_reject_receive_any_notifications']??'0';
        
        //-----
        $this->initAndCheck($id);
        $dataset = $this->params;
        $aff = $this->objs['objThis']->save2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $result['row'] = $this->objs['objThis'];
        $this->result = $result;
        return $result;
    }  
}
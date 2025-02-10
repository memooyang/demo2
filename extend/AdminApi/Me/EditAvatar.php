<?php
/*
\AdminApi\Me\EditAvatar
*/
namespace AdminApi\Me;

class EditAvatar extends \AdminApi\Me\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::admin();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $id = $this->params['id']??'';
        $value = $this->params['value']??''; // /images/avatars/animal-meerkat.png
        if(empty($id)){ throw new \Exception('沒有指定用戶'); }
        if(empty($value)){ throw new \Exception('沒有指定頭像'); }
        
        //-----
        $this->initAndCheck();
        $dataset = array();
        $dataset['avatar'] = $value;
        $aff = $this->objs['objThis']->save2($dataset);
        // _json($this->objs['objAdminUsers']);
        
        //更新本人資訊
        \Web::admin($this->objs['objThis']);
        // if($user['id'] == $this->objs['objThis']['id']){
        //     \RdbHandler\User\UpdateMySession::doProcess($this->objs['objThis']);          
        // }
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $result['value'] = $value;
        $this->result = $result;
        return $result;
    }  
}
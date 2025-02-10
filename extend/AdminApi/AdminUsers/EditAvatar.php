<?php
/*
\AdminApi\AdminUsers\EditAvatar
*/
namespace AdminApi\AdminUsers;

class EditAvatar extends \AdminApi\AdminUsers\Base
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
        $this->initAndCheck($id);
        $dataset = array();
        $dataset['avatar'] = $value;
        $aff = $this->objs['objThis']->save2($dataset);
        
        //更新本人資訊
        \Web::admin($this->objs['objThis']);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $result['value'] = $value;
        $this->result = $result;
        return $result;
    }  
}
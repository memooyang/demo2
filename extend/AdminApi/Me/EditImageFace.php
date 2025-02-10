<?php
/*
\AdminApi\Me\EditImageFace
*/
namespace AdminApi\Me;

class EditImageFace extends \AdminApi\Me\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::user();
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
        $aff = $this->objs['objUser']->save2($dataset);
        // _json($this->objs['objAdminUsers']);
        
        //更新本人資訊
        if($user['id'] == $this->objs['objUser']['id']){
            \RdbHandler\User\UpdateMySession::doProcess($this->objs['objUser']);          
        }
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $result['value'] = $value;
        $this->result = $result;
        return $result;
    }  
}
<?php
/*
\AdminApi\Users\EditWithUserProfiles
*/
namespace AdminApi\Users;

class EditWithUserProfiles extends \AdminApi\Users\Base
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
        $objUserProfiles = $this->initUserProfiles($id);
        
        //-----
        $dataset = $this->params;
        if(array_key_exists('lifes', $dataset)){
            $dataset['lifes'] = implode(',', $this->params['lifes']);
        }
        
        // _json($dataset);
        $aff = $this->objs['objUserProfiles']->save2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
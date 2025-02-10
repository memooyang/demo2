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
        
        // //-----
        // $topic = $this->params['topic']??'';
        // if(empty($topic)){ throw new \Exception('請輸入標題'); }
        
        //-----
        $this->initAndCheck($id);
        $objUserProfiles = $this->initUserProfiles($id);
        
        //-----users
        $dataset = [];
        if(array_key_exists('email', $this->params)){
            $dataset['email'] = $this->params['email'];
        }
        $aff = $this->objs['objThis']->save2($dataset);
        
        //-----user_profiles
        $dataset = [];
        if(array_key_exists('lifes', $this->params)){
            $dataset['lifes'] = implode(',', $this->params['lifes']);
        }
        if(array_key_exists('county', $this->params)){
            $dataset['county'] = $this->params['county'];
        }
        if(array_key_exists('district', $this->params)){
            $dataset['district'] = $this->params['district'];
        }
        if(array_key_exists('zipcode', $this->params)){
            $dataset['zipcode'] = $this->params['zipcode'];
        }
        if(array_key_exists('address', $this->params)){
            $dataset['address'] = $this->params['address'];
        }
        $aff = $this->objs['objUserProfiles']->save2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
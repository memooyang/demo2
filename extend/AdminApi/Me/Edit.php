<?php
/*
\AdminApi\Me\EditInfo
*/
namespace AdminApi\Me;

class Edit extends \AdminApi\Me\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::admin();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $id = $this->params['id']??'';
        $name = $this->params['name']??'';
        $email = $this->params['email']??'';
        // $nickname = $this->params['nickname']??'';
        // $phone = $this->params['phone']??'';
        // $mobile = $this->params['mobile']??'';
        if(empty($id)){ throw new \Exception('沒有指定用戶'); }
        if(empty($name)){ throw new \Exception('請輸入用戶姓名'); }
        if(empty($email)){ throw new \Exception('請輸入用戶Email'); }
        // if(empty($nickname)){ throw new \Exception('請輸入用戶顯示名稱'); }
        if(\Validator\Email::check($email) == false){ throw new \Exception('Email格式錯誤'); }
        // if(\Validator\Mobile::check($mobile, true) == false){ throw new \Exception('用戶手機格式錯誤'); }
        
        //-----
        $this->initAndCheck();
        $dataset = $this->params;
        $aff = $this->objs['objThis']->save2($dataset);
        
        //更新本人資訊
        \Web::admin($this->objs['objThis']);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $result['row'] = $dataset;
        $this->result = $result;
        return $result;
    }  
}
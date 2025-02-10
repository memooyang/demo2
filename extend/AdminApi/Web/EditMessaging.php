<?php
/*
\AdminApi\Web\EditMessaging
*/
namespace AdminApi\Web;

class EditMessaging extends \AdminApi\Web\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::user();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $id = $this->params['id']??'';
        if(empty($id)){ throw new \Exception('沒有對應的資料'); }
        
        //-----
        $thisRow = $this->initAndCheck($id, true);
        
        //-----
        $rdb = new \Rdb\WebSocialSettings();
        $map = [];
        $map['id'] = $id;
        $map['mode'] = $thisRow['mode'];
        $map['domain'] = $thisRow['domain'];
        $obj = $rdb->where($map)->find();
        if(empty($obj)){ throw new \Exception('沒有相關設定'); }
        
        //-----
        $dataset = $this->params;
        // $dataset['line_channel_account'] = $this->params['line_channel_account']??'';
        // $dataset['line_messaging_channel_id'] = $this->params['line_messaging_channel_id']??'';
        // $dataset['line_messaging_channel_secret'] = $this->params['line_messaging_channel_secret']??'';
        // $dataset['line_messaging_channel_token'] = $this->params['line_messaging_channel_token']??'';
        $aff = $obj->save2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
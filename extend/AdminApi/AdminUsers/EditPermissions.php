<?php
/*
\AdminApi\AdminUsers\EditPermissions
權限/管理者 關聯表
*/
namespace AdminApi\AdminUsers;

class EditPermissions extends \AdminApi\AdminUsers\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::admin();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $id = $this->params['id']??'';
        if(empty($id)){ throw new \Exception('沒有對應的資料'); }
        $permission_ids = $this->params['permission_ids']??'';
        if(empty($permission_ids)){ throw new \Exception('沒有指定身份'); }
        
        //-----
        $this->initAndCheck($id);
        $dataset = [];
        if($permission_ids){ 
            $dataset['permission_id'] = $permission_ids[0];
            $dataset['permission_ids'] = implode(',', $permission_ids);
            //-----刪除舊資料
            $rdb = new \Rdb\AdminUserPermissions();
            $map = array();
            $map['user_id'] = $this->objs['objThis']['id'];
            $rdb->where($map)->delete();
            
            //-----
            $rdb = new \Rdb\AdminUserPermissions();
            foreach($permission_ids as $permission_id){
                $dataset2 = array();
                $dataset2['permission_id'] = $permission_id;
                $dataset2['user_id'] = $this->objs['objThis']['id'];
                $aff = $rdb->add2($dataset2);
            }
        }
        // _json($dataset);
        $aff = $this->objs['objThis']->save2($dataset);
        
        //-----輸出結果
        $result = [];
        $result['aff'] = $aff;
        $this->result = $result;
        return $result;
    }  
}
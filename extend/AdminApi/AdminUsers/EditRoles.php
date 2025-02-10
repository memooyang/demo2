<?php
/*
\AdminApi\AdminUsers\EditRoles
身份/管理者 關聯表
*/
namespace AdminApi\AdminUsers;

class EditRoles extends \AdminApi\AdminUsers\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::admin();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $id = $this->params['id']??'';
        if(empty($id)){ throw new \Exception('沒有對應的資料'); }
        $role_ids = $this->params['role_ids']??'';
        if(empty($role_ids)){ throw new \Exception('沒有指定身份'); }
        
        // //-----
        // $topic = $this->params['topic']??'';
        // if(empty($topic)){ throw new \Exception('請輸入標題'); }
        
        //-----
        $this->initAndCheck($id);
        $dataset = [];
        if($role_ids){ 
            $dataset['role_id'] = $role_ids[0];
            $dataset['role_ids'] = implode(',', $role_ids);
            //-----刪除舊資料
            $rdb = new \Rdb\AdminRoleUsers();
            $map = array();
            $map['user_id'] = $this->objs['objThis']['id'];
            $rdb->where($map)->delete();
            
            //-----
            $rdb = new \Rdb\AdminRoleUsers();
            foreach($role_ids as $role_id){
                $dataset2 = array();
                $dataset2['role_id'] = $role_id;
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
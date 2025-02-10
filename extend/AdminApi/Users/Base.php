<?php
/*
\AdminApi\Users\Base
*/
namespace AdminApi\Users;

class Base extends \AdminApi\Base
{

    public function initAndCheck($id, $is_prepare = false)
    {
        //-----
        $web_id = \Web::id();
        $rdb = new \Rdb\Users();
        $map = [];
        $map['web_id'] = $web_id;
        $map['id'] = $id;
        $obj = $rdb->where($map)->find();
        if(empty($obj)){ throw new \Exception('資料不存在'); }
        $this->objs['objThis'] = $obj;
        if($is_prepare){
            $obj = $obj->toArray();
            $obj = $rdb->prepare($obj);
        }
        return $obj;
    }

    public function initUserProfiles($user_id, $is_prepare = false)
    {
        if(empty($user_id)){ throw new \Exception('資料不存在'); }
        $web_id = \Web::id();
        $rdb = new \Rdb\UserProfiles();
        $map = [];
        $map['web_id'] = $web_id;
        $map['user_id'] = $user_id;
        $obj = $rdb->where($map)->find();
        if(empty($obj)){ throw new \Exception('資料不存在'); }
        $this->objs['objUserProfiles'] = $obj;
        if($is_prepare){
            $obj = $obj->toArray();
            $obj = $rdb->prepare($obj);
            $this->vars['rowUserProfiles'] = $obj;
        }
        return $obj;
    }

}
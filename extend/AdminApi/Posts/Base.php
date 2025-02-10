<?php
/*
\AdminApi\Posts\Base
*/
namespace AdminApi\Posts;

class Base extends \AdminApi\Base
{

    public function initAndCheck($id, $is_prepare = false)
    {
        //-----
        $web_id = \Web::id();
        $rdb = new \Rdb\Posts();
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
}
<?php
/*
\AdminApi\Web\Base
*/
namespace AdminApi\Web;

class Base extends \AdminApi\Base
{

    public function initAndCheck($id, $is_prepare = false)
    {
        //-----
        $rdb = new \Rdb\Web();
        $map = [];
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
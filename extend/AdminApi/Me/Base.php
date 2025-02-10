<?php
/*
\AdminApi\Me\Base
*/
namespace AdminApi\Me;

class Base extends \AdminApi\Base
{

    public function initAndCheck($is_prepare = false)
    {
        //-----
        $web_id = \Web::id();
        $user = \Web::admin();
        $rdb = new \Rdb\AdminUsers();
        $map = \RdbCondition\Web::init();
        $map['id'] = $user['id'];
        $row = $rdb->where($map)->find();
        if(empty($row)){ throw new \Exception('資料不存在'); }
        $this->objs['objThis'] = $row;
        if($is_prepare){
            $row = $row->toArray();
            $row = $row->prepare($row);
            $this->instance['rowUser'] = $row;
        }
        return $row;
    }
}
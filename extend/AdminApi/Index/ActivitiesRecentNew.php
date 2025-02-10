<?php
/*
\AdminApi\Index\ActivitiesRecentNew
*/
namespace AdminApi\Index;

class ActivitiesRecentNew extends \AdminApi\Index\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::admin();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $recent_new_at = \Helper\Date\Sub::day(90, _date());
        $rdb = new \Rdb\Activities();
        $map = \RdbCondition\Web::init();
        $map['is_remove'] = '0';
        $map['status'] = '1';
        $rows = $rdb
        ->where($map)
        ->where('created_at', '>=', $recent_new_at)
        ->order('id desc')
        ->limit('5')
        ->select();
        $total = $rdb->count();
        $rows = $rdb->prepareRows($rows);
        
        //-----
        $result = [];
        $result['total'] = $total;
        $result['rows'] = $rows;
        $this->result = $result;
        return $result;
    }  
}
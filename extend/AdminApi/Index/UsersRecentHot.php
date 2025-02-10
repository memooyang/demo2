<?php
/*
\AdminApi\Index\UsersRecentHot
活躍的會員
30天
*/
namespace AdminApi\Index;

class UsersRecentHot extends \AdminApi\Index\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::admin();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        $recent_at = \Helper\Date\Sub::day(14, _date());
        $rdb = new \Rdb\Users();
        $map = \RdbCondition\Web::init();
        $map['is_remove'] = '0';
        $rows = $rdb
        ->field($rdb->useFields['base'])
        ->where($map)
        ->where('last_login', '>=', $recent_at)
        ->order('last_login desc, id desc')
        ->limit('6')
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
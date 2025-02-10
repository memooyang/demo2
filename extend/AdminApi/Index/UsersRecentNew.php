<?php
/*
\AdminApi\Index\UsersRecentNew
近期新增的會員
30天
*/
namespace AdminApi\Index;

class UsersRecentNew extends \AdminApi\Index\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::admin();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        //SELECT * FROM `lohasys_users` WHERE `web_id` = 1 AND `is_remove` = 0 AND `created_at` >= '2024-12-01 12:08:32' ORDER BY `id` DESC
        $recent_at = \Helper\Date\Sub::day(14, _date());
        $rdb = new \Rdb\Users();
        $map = \RdbCondition\Web::init();
        $map['is_remove'] = '0';
        $rows = $rdb
        ->field($rdb->useFields['base'])
        ->where($map)
        ->where('created_at', '>=', $recent_at)
        ->order('id desc')
        ->limit('5')
        ->select();
        $total = $rdb->debug();
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
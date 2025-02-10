<?php
/*
\AdminApi\Index\PostsRecentNew
*/
namespace AdminApi\Index;

class PostsRecentNew extends \AdminApi\Index\Base
{
    public function doProcess()
    {
        //-----
        $user = \Web::admin();
        if(empty($user)){ throw new \Exception('尚未登入'); }
        
        //-----
        //SELECT * FROM `lohasys_posts` WHERE `web_id` = 1 AND `is_remove` = 0 AND `created_at` >= '2024-12-01 17:32:02' ORDER BY `id` DESC LIMIT 5
        $recent_at = \Helper\Date\Sub::day(30, _date());
        $rdb = new \Rdb\Posts();
        $map = \RdbCondition\Web::init();
        $map['is_remove'] = '0';
        // $map['is_publish'] = '1';
        // $map['status'] = '1';
        $rows = $rdb
        ->where($map)
        ->where('created_at', '>=', $recent_at)
        ->order('id desc')
        ->limit('5')
        ->select();
        // $rdb->debug();
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
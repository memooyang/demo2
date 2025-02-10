<?php
/*
\AdminApi\Index\Quicklink
*/
namespace AdminApi\Index;

class Quicklink extends \AdminApi\Index\Base
{
    public function doProcess()
    {
        // //-----
        // $web = \Web::data();
        // $user = \Web::admin();
        // // _test($web);
        // // _test($user);
        // if(empty($web)){ throw new \Exception('尚未登入'); }
        // if(empty($user)){ throw new \Exception('尚未登入'); }
        
        // //-----
        // $total = [];
        
        // //-----totalActivities
        // $rdb = new \Rdb\Activities();
        // $c = $rdb
        // ->where('web_id', $web['id'])
        // ->where('is_remove', '0')
        // ->count();
        // $total['activities'] = $c;
        
        // //-----totalUsers
        // $rdb = new \Rdb\Users();
        // $c = $rdb
        // ->where('web_id', $web['id'])
        // ->where('is_remove', '0')
        // ->count();
        // $total['users'] = $c;
        
        // //-----totalPosts
        // $rdb = new \Rdb\Posts();
        // $c = $rdb
        // ->where('web_id', $web['id'])
        // ->where('is_remove', '0')
        // ->count();
        // $total['posts'] = $c;
        
        // //-----totalProducts
        // // $rdb = new \Rdb\Products();
        // // $c = $rdb
        // // // ->where('web_id', $web['id'])
        // // // ->where('is_paid', '1')
        // // ->count();
        // // $total['products'] = $c;
        // $total['products'] = 0;
        
        //-----輸出結果
        // _json($total);
        $total = [];
        $result = [];
        $result['total'] = $total;
        $this->result = $result;
        return $result;
    }  
}
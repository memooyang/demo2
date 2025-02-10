<?php
/*
\AdminApi\Index\InfoOrderPaid
*/
namespace AdminApi\Index;

class InfoOrderPaid extends \AdminApi\Index\Base
{
    public function doProcess()
    {
        //-----
        $web = \Web::data();
        $user = \Web::user();
        $school = \School::data();
        if(empty($web)){ throw new \Exception('尚未登入'); }
        if(empty($user)){ throw new \Exception('尚未登入'); }
        if(empty($school)){ throw new \Exception('尚未登入'); }
        
        //-----
        $total = [];
        
        //-----
        $rdb = new \Rdb\Course();
        $c = $rdb
        ->where('web_id', $web['id'])
        ->where('school_id', $school['id'])
        ->count();
        $total['course'] = $c;
        
        //-----
        $rdb = new \Rdb\Student();
        $c = $rdb
        ->where('web_id', $web['id'])
        ->where('school_id', $school['id'])
        ->count();
        $total['student'] = $c;
        
        //-----輸出結果
        $result = [];
        $result['total'] = $total;
        $this->result = $result;
        return $result;
    }  
}
<?php
/*
\AdminApi\Index\StarTotal
*/
namespace AdminApi\Index;

class StarTotal extends \AdminApi\Index\Base
{
    public function doProcess()
    {
        //-----
        $web = \Web::data();
        $user = \Web::user();
        $school = \School::data();
        // _test($web);
        // _test($user);
        // _test($school);
        if(empty($web)){ throw new \Exception('尚未登入'); }
        if(empty($user)){ throw new \Exception('尚未登入'); }
        if(empty($school)){ throw new \Exception('尚未登入'); }
        
        //-----
        $total = [];
        
        //-----
        $rdb = new \Rdb\CourseStarTotal();
        $objCourseStarTotal = $rdb
        ->where('web_id', $web['id'])
        ->where('school_id', $school['id'])
        ->find();
        $total['CourseStarTotal'] = $objCourseStarTotal['amount'];
        
        //-----輸出結果
        // _json($total);
        $result = [];
        $result['total'] = $total;
        $this->result = $result;
        return $result;
    }  
}
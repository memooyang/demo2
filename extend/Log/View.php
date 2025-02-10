<?php
/*
\Log\View
*/
namespace Log;

class View
{
    /*
    @use
    \Log\View::error($e, $response);
    */
    public static function error($e, $response = array())
    {
        if(is_object($e) == true){
            $response_message = $e->getMessage();
            $response_code = $e->getCode();
        }
        $user = \Web::user();
        $rdb = new \Rdb\LogViewError();
        $dataset = array();
        $dataset['web_id'] = $user['web_id'];
        $dataset['user_id'] = $user['id'];
        $dataset['user_role'] = $user['role'];
        $dataset['host'] = $_SERVER['HTTP_HOST'];
        $dataset['response_status'] = 'error';
        $dataset['response_message'] = $response_message;
        $dataset['response_code'] = $response_code;
        $dataset['request_data'] = json_encode($_REQUEST);
        $dataset['response_data'] = json_encode($response);
        $dataset['created_at'] = _date();
        $dataset['ip'] = _ip();
        $aff = $rdb->add($dataset);
        $dataset['id'] = $aff;
        return $dataset;
    }

}
<?php
/*
\Log\Api
*/
namespace Log;

class Api
{
    /*
    @use
    \Log\Api::success
    */
    public static function success($response)
    {
        if(is_string($response) == true){
            $response = json_decode($response, true);
        }
        $user = \Web::user();
        $rdb = new \Rdb\LogApiSuccess();
        $dataset = array();
        $dataset['user_id'] = $user['id'];
        $dataset['user_role'] = $user['role'];
        $dataset['host'] = $_SERVER['HTTP_HOST'];
        $dataset['response_status'] = 'success';
        $dataset['response_message'] = $response['message']??null;
        $dataset['response_code'] = $response['code']??null;
        $dataset['request_data'] = json_encode($_REQUEST);
        $dataset['response_data'] = json_encode($response);
        $dataset['created_at'] = _date();
        $dataset['ip'] = _ip();
        $aff = $rdb->add($dataset);
        return $dataset;
    }

    /*
    */
    public static function error($response)
    {
        if(is_string($response) == true){
            $response = json_decode($response, true);
        }
        $user = \Web::user();
        $rdb = new \Rdb\LogApiError();
        $dataset = array();
        $dataset['user_id'] = $user['id'];
        $dataset['user_role'] = $user['role'];
        $dataset['host'] = $_SERVER['HTTP_HOST'];
        $dataset['response_status'] = 'error';
        $dataset['response_message'] = $response['message']??null;
        $dataset['response_code'] = $response['code']??null;
        $dataset['request_data'] = json_encode($_REQUEST);
        $dataset['response_data'] = json_encode($response);
        $dataset['created_at'] = _date();
        $dataset['ip'] = _ip();
        $aff = $rdb->add($dataset);
        return $dataset;
    }

    /*
    */
    public static function exception($e)
    {
        if(is_string($response) == true){
            $response = json_decode($response, true);
        }
        $user = \Web::user();
        $rdb = new \Rdb\LogApiException();
        $dataset = array();
        $dataset['user_id'] = $user['id'];
        $dataset['user_role'] = $user['role'];
        $dataset['host'] = $_SERVER['HTTP_HOST'];
        // $dataset['module'] = MODULE_NAME;
        // $dataset['controller'] = CONTROLLER_NAME;
        // $dataset['action'] = ACTION_NAME;
        $dataset['response_status'] = 'error';
        $dataset['response_message'] = $response['message']??null;
        $dataset['response_code'] = $response['code']??null;
        $dataset['request_data'] = json_encode($_REQUEST);
        $dataset['response_data'] = json_encode($response);
        $dataset['created_at'] = _date();
        $dataset['ip'] = _ip();
        $aff = $rdb->add($dataset);
        return $dataset;
    }
}
<?php
/*
\Api\Response
*/
namespace Api;

class Response
{
    /*
    輸出前準備回應內容
    @use
    \Api\Response::prepare
     */
    public static function prepare($response = array())
    {
        if(is_object($response)){ //Exception
            $code = $response->getCode();
            $message = $response->getMessage();
            $arr = array();
            $arr['code'] = $code;
            $arr['message'] = $message;
        }else{
            $arr = array();
            $arr['data'] = $response;
        }
        return $arr;
    }
    
    /*
    @use
    \Api\Response::success
    @return 
    {
        status : success
        status_code : 1
        code : ''
        message : ''
        data : {}
    }
    */
    public static function success($response = array(), $message = '', $code = '')
    {
        header('Content-Type: application/json; charset=utf-8');
        
        //-----
        $data = $response;
        $code = ($code)?$code:'00000';
        $message = ($message)?$message:'成功';
        
        //-----
        $arr = array(
            'code'      => $code,
            'message'   => $message,
            'status'    => 'success',
            'state'     => 1,
            'data'      => $data,
        );
        $result = json_encode($arr, JSON_UNESCAPED_UNICODE);
        echo $result;
        exit;
    }

    /*
    @use
    \Api\Response::error
    @params
        $response : Exception / Array
    @return 
    {
        status : error
        status_code : 0
        code : ''
        message : ''
        data : {}
    }
    */
    public static function error($response, $message = '', $code = '')
    {
        header('Content-Type: application/json; charset=utf-8');
        
        if((is_object($response) && $response instanceof \Exception)){ //Exception
            //-----傳Exception進來
            $data = array();
            $code = $response->getCode();
            $message = $response->getMessage();
        }else{
            //-----傳Array資料進來
            $data = $response??array();
        }
        
        //-----
        $code = $code??'-1';
        $message = $message??'失敗';
        
        //-----
        $arr = array(
            'code'      =>$code,
            'message'   =>$message,
            'status'    =>'error',
            'state'     =>0,
            'data'      =>$data,
        );
        $result = json_encode($arr, JSON_UNESCAPED_UNICODE);
        echo $result;
        exit;
    }

}
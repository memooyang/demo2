<?php
/*
\Utils\Curl
*/
namespace Utils;

class Curl
{
    public $user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
    //curl get
    public static function get($url, $cookiefile = null) 
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, self::$user_agent);
        if(!(empty($cookiefile))){
            curl_setopt($curl, CURLOPT_COOKIEJAR, $cookiefile);
            curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiefile);
        }
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($curl);
        return $data;
    }

    //curl post

    public static function post($url, $post=null, $cookiefile = null) 
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, self::$user_agent);
        if(!(empty($cookiefile))){
            curl_setopt($curl, CURLOPT_COOKIEJAR, $cookiefile);
            curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiefile);
        }
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($curl);
        return $data;
    }

    //curl post

    public static function query($url) 
    {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, self::$user_agent);
        // curl_setopt($curl, CURLOPT_COOKIEJAR, $cookiefile);
        // curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiefile);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($curl);
        return $data;
    }

    //curl post
    /*
    // $data = Xs_Utils_Curl::post_direct($url1,array('location=cn&keyword={$text}'));
    
    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS, 
        http_build_query(array( "a"=>"123", "b"=>"321"))
    ); 

    //----------

    如果要挾帶檔案，和一般的POST動作一樣，只需注意二點:

    以multipart/form-data模式傳送
    array內容前面加個@符號，後面接檔案的「絕對路徑」
    cURL會自動去讀檔和計算大小，相當方便！
    http://blog.roodo.com/esabear/archives/16358749.html
    
    */
    public static function post_direct($url, $post=null) 
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, self::$user_agent);
        // curl_setopt($curl, CURLOPT_COOKIEJAR, $cookiefile);
        // curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiefile);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($curl);
        return $data;
    }
    
    public static function file_exists($url) 
    {
        $curl = curl_init($url);

        //don't fetch the actual page, you only want to check the connection is ok
        curl_setopt($curl, CURLOPT_NOBODY, true);

        //do request
        $result = curl_exec($curl);

        $ret = false;

        //if request did not fail
        if ($result !== false) {
            //if request was ok, check response code
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  

            if ($statusCode == 200) {
                $ret = true;   
            }
        }

        curl_close($curl);

        return $ret;
    }
}


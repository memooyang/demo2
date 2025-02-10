<?php
/*
\Web\Secrity
*/
namespace Web;

class Secrity
{
    
    const ORDER_KEY = 'order';
    const MAIL_KEY = 'mail';
    const USER_KEY = 'memoo';
    // const USER_COOKIE_KEY = 'user_cookie_key';
    const REGISTER_KEY = 'register';
    const FORGET_PASSWORD_KEY = 'forget_password';
    const PARAMS_KEY = 'parameters';
    const KEY = 'default';
    const TEXT_KEY = 'text';
    
    /*
    加密/解密
    @params string $encrypt
    @params string $key
    */
    // public static function encodeUserCookie($encrypt,$key="") 
    // {     
    //     if(empty($key)){ $key = self::USER_COOKIE_KEY; }
    //     return self::encryptJson($encrypt, $key);
    // }  
    // public static function decodeUserCookie($decrypt,$key="") 
    // {     
    //     if(empty($key)){ $key = self::USER_COOKIE_KEY; }
    //     $decrypt = utf8_encode($decrypt); 
    //     return self::decryptJson($decrypt, $key);
    // } 
      
    public static function encodeJson($string,$key="") 
    { 
        return self::encryptJson($string,$key);
    }
    public static function encryptJson($string,$key="") 
    {  
        $encode = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encode;  
    }  
      
    public static function decodeJson($string,$key="") 
    { 
        return self::decryptJson($string,$key);
    }
    public static function decryptJson($string,$key="") 
    {     
        $decode = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decode;  
    }
    
    /*
    加密/解密
    @params string $encrypt
    @params string $key
    */
    public static function encodeMail($encrypt,$key="") 
    {     
        if(empty($key)){ $key = self::MAIL_KEY; }
        return self::encrypt($encrypt, $key);
    }  
    public static function decodeMail($decrypt,$key="") 
    {     
        if(empty($key)){ $key = self::MAIL_KEY; }
        return self::decrypt($decrypt, $key);
    } 
    
    /*
    使用者 忘記密碼 加密/解密
    @params string $encrypt
    @params string $key
    */
    public static function encodeUserForgetPassword($encrypt,$key="") 
    {     
        if(empty($key)){ $key = self::FORGET_PASSWORD_KEY; }
        return self::encrypt($encrypt, $key);
    }  
    public static function decodeUserForgetPassword($decrypt,$key="") 
    {     
        if(empty($key)){ $key = self::FORGET_PASSWORD_KEY; }
        return self::decrypt($decrypt, $key);
    } 
    
    /*
    使用者註冊 加密/解密
    @params string $encrypt
    @params string $key
    */
    public static function encodeUserRegister($encrypt,$key="") 
    {     
        if(empty($key)){ $key = self::REGISTER_KEY; }
        return self::encrypt($encrypt, $key);
    }  
    public static function decodeUserRegister($decrypt,$key="") 
    {     
        if(empty($key)){ $key = self::REGISTER_KEY; }
        return self::decrypt($decrypt, $key);
    }  
    
    /*
    使用者密碼加密/解密
    @params string $encrypt
    @params string $key
    */
    public static function encodeUserPassword($encrypt,$key="") 
    {     
        if(empty($key)){ $key = self::USER_KEY; }
        return self::encrypt($encrypt, $key);
    }  
    public static function decodeUserPassword($decrypt,$key="") 
    {     
        if(empty($key)){ $key = self::USER_KEY; }
        return self::decrypt($decrypt, $key);
    }  

    /*
    */
    public static function encodeForOrderSuccess($encrypt,$key="") 
    {     
        if(empty($key)){ $key = self::ORDER_KEY; }
        return self::encrypt($encrypt, $key);
    }  
    public static function decodeForOrderSuccess($decrypt,$key="") 
    {     
        if(empty($key)){ $key = self::ORDER_KEY; }
        return self::decrypt($decrypt, $key);
    }

    /*
    加密/解密
    @params array $arr
    @params string $key
    */
    public static function encodeText($text='',$key="") 
    {
        if(empty($key)){ $key = self::TEXT_KEY; }
        $str = '';
        $str = base64_encode($text);
        return $str;
    }  
    public static function decodeText($str,$key="") 
    {
        if(empty($key)){ $key = self::TEXT_KEY; }
        $str = base64_decode($str);
        return $str;
    }  

    /*
    參數加密/解密
    @params array $arr
    @params string $key
    */
    public static function encodeParams($arr=array(),$key="") 
    {
        if(empty($arr)){ return ''; }
        if(empty($key)){ $key = self::PARAMS_KEY; }
        $str = '';
        $str = http_build_query($arr);
        $str = base64_encode($str);
        return $str;
    }  
    public static function decodeParams($str,$key="") 
    {
        if(empty($key)){ $key = self::PARAMS_KEY; }
        $str = base64_decode($str);
        $arr = array();
        parse_str($str, $arr);
        return $arr;
    }  
      
    public static function encode($encrypt,$key="") 
    { 
        return self::encrypt($encrypt,$key);
    }
    public static function encrypt($plaintext = '', $key = "") 
    {     
        // $plaintext = $encrypt;
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
        return $ciphertext;  
    }  
      
    public static function decode($encrypt,$key="") 
    { 
        return self::decrypt($encrypt,$key);
    }
    public static function decrypt($ciphertext,$key="") 
    {     
        //decrypt later....
        $c = base64_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        if (hash_equals($hmac, $calcmac))// timing attack safe comparison
        {
            echo $original_plaintext."\n";
        }
        return $decrypted;  
    }

}

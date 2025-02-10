<?php
/*
\Hash\Bcrypt
@instead-of 
    use Illuminate\Support\Facades\Hash;
    Hash::make($password);
*/
namespace Hash;

class Bcrypt
{
    /*
    @use
        $password_hash = \Hash\Bcrypt::make($password);
    */
    public static function make($password)
    {
        if(empty($password)){ return false; }
        $cost = 10; // Default cost
        $password_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => $cost]);
        return $password_hash;
    }
    
    /*
    @use
        $validate = \Hash\Bcrypt::validate($password, $password_hash);
    @test
        $password = '1Qazxsw23eddc';
        $password_hash = \Hash\Bcrypt::make($password);
        $validate = \Hash\Bcrypt::validate($password, $password_hash);
        if(empty($validate)){ throw new \Exception('密碼錯誤'); }
    */
    public static function validate($password, $password_hash)
    {
        if(empty($password)){ return false; }
        if (password_verify($password, $password_hash)) { return true; }
        return false;
    }
    
    /*
    @use
        $info = \Hash\Bcrypt::info($password_hash);
    */
    public static function info($password_hash)
    {
        $data = password_get_info($password_hash);
        return $data;
    }
    
}
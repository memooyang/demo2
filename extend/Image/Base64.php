<?php
/*
\Image\Base64
*/
namespace Image;

class Base64
{
    /*
    @tip
    轉換Base64圖檔為實體圖片檔
    */
    public static function toImage($image_base64, $image_save_to) 
    {
        if(empty($image_base64)){ return false; }
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_base64));
        file_put_contents($image_save_to, $data);
        return $data;
    }
}
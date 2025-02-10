<?php
/*
檔案
\Validator\File
*/
namespace Validator;

class File
{
    /*
    驗證URL / 圖片 / 檔案
    @use
    \Validator\File::check($data);
    */
    public static function check($url)
    {
        if (@file_get_contents($url, 0, NULL, 0, 1)) {
            return 1;
        }
        return 0;
    }

}
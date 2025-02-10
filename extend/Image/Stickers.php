<?php
/*
\Image\Stickers
*/
namespace Image;

class Stickers
{
    const PATH = 'images/stickers/';

    /*
    */
    public static function getFiles($package = 'default') 
    {
        $path = self::PATH;
        $path = "{$path}{$package}/"; 
        $arr = glob("{$path}{*.png,*.PNG,*.jpg,*.JPG,*.jpeg,*.svg}", GLOB_BRACE);
        return $arr;
    }

}
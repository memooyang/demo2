<?php
/*
\Image\Line
*/
namespace Image;

class Line
{
    const PATH = 'https://profile.line-scdn.net/';

    /*
    https://profile.line-scdn.net/xxxxxxx
    */
    public static function avatar($key = '') 
    {
        $path = self::PATH;
        $path = "{$path}{$key}"; 
        return $path;
    }

}
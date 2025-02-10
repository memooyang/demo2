<?php
/*
\Image\Raw
*/
namespace Image;

class Raw
{
    /*
    @param string $data
    @return data 
    */
    public static function decode($data) 
    {
        $data = rawurldecode($data);
        return $data;
    }

    /*
    @param string $data
    @return data 
    */
    public static function encode($data) 
    {
        $data = rawurlencode($data);
        return $data;
    }
}
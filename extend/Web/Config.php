<?php
/*
\Web\Config
*/
namespace Web;

class Config
{
    public static function load($file)
    {
        if (file_exists($file)) {
            $data = require $file;
        }
        return $data;
    }

    public static function ini($file)
    {
        return parse_ini_file($file, true);
    }
}



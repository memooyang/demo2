<?php
/*
\Web\Identity
*/
namespace Web;

class Identity
{
    public static function factory()
    {
        $data = md5(uniqid().microtime(true));
        return $data;
    }
}



<?php
/*
\RdbCondition\Web
*/
namespace RdbCondition;

class Web
{
    /*
    @use
    \RdbCondition\Web::init();
    */
    public static function init($map = [])
    {
        $map['web_id'] = \Web::id();
        return $map;
    }

}



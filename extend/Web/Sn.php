<?php
/*
\Web\Sn
*/
namespace Web;

class Sn
{
    public static function _($prefix = 'sn', $prefix2 = '', $symbol = '_')
    {
        // $web_id = \Web::id();
        // $user = \Web::user();
        // $user_id = $user['id'];
        // $user_id = '';
        // $sn = $prefix.$web_id.$user_id.uniqid();
        $sn = '';
        if($prefix){
            $sn = $prefix . $symbol;
        }
        if($prefix2){
            $sn .= $prefix2 . $symbol;
        }
        $sn .= uniqid();
        return $sn;
    }
}
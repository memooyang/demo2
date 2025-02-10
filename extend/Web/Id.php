<?php
/*
\Web\Id
*/
namespace Web;

class Id
{

    public static function _()
    {
        $id = md5(uniqid().microtime(true));
        return $id;
    }

    public static function user($web_id = '', $user_id = '', $options = array())
    {
        $id = md5($web_id.$user_id.uniqid().microtime(true));
        return $id;
    }

    public static function key($options = array())
    {
        $id = md5($options['prefix'].uniqid().microtime(true).$options['postfix']);
        return $id;
    }

    public static function uniqid($options = array())
    {
        $id = md5(uniqid());
        return $id;
    }
    
    public static function microtime($options = array())
    {
        $id = \Helper\Microtime\Output::_();
        return $id;
    }
}
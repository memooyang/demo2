<?php
/*
驗證IP
\Validator\IP
*/
namespace Validator;

class IP
{
    /*
    驗證IP
    https://xyz.cinc.biz/2012/12/phpip.html
    filter_var 說明：http://php.net/manual/en/function.filter-var.php

    filter_var 可用的 Validate filters：http://php.net/manual/en/filter.filters.validate.php
    FILTER_VALIDATE_IP：判斷是否為有效IP

    filter_var 可用的 Filter flags： http://php.net/manual/en/filter.filters.flags.php
    FILTER_FLAG_IPV4：判斷是否為 IP4
    FILTER_FLAG_IPV6：判斷是否為 IP6
    FILTER_FLAG_NO_PRIV_RANGE：遇到私有 IP 時回傳 FALSE。
    IP4 私有IP範圍：10.0.0.0/8, 172.16.0.0/12 and 192.168.0.0/16
    IP6 私有IP範圍：starting with FD or FC
    FILTER_FLAG_NO_RES_RANGE：遇到保留 IP 時回傳 FALSE。
    IP4 保留 IP 範圍：0.0.0.0/8, 169.254.0.0/16, 192.0.2.0/24 and 224.0.0.0/4
    IP6：This flag does not apply to IPv6 addresses
    以上的 Filter flags 須與 FILTER_VALIDATE_IP 一起使用
    @use
    \Validator\IP::check($data);
    */
    public static function check($data = '', $is_allow_empty = false){
        if(empty($data)){ return $is_allow_empty; }
        $is = filter_var($data, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        return $is;
    }

}
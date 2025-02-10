<?php
/*
\Preg\Base
*/
namespace Preg;

class Base
{
    
    /*
    匹配由26个英文字母组成的字符串 
    */
    public static function getNumberAndText($data)
    {   
        return preg_replace('/[^a-zA-Z0-9 ]/i','',$data);
    }
    //過濾斷行
    public static function filterBR($string)
    {   
        // $string = ereg_replace("\r","",$string); 
        // $string = ereg_replace("\n","",$string);  //ereg_replace("\n","",$str);
        return $string; 
    }
    //取文字 // 無數字
    public static function getNoNumber($data)
    {   
        return preg_replace('/[0-9]/','',$data);
    }
    //取數字
    public static function getNumber($data)
    {   
        return preg_replace('/[^\d]/','',$data);
    }
    //取數字
    public static function getHTMLTag($data)
    {   
        return preg_replace('<(\S*?)[^>]*>.*?</\1>|<.*?/> ','',$data);
    }

    public static function getAllLink($string) 
    { 
        $string = str_replace("\r","",$string); 
        $string = str_replace("\n","",$string); 

        $regex[url] = "((http|https|ftp|telnet|news):\/\/)?([a-z0-9_\-\/\.]+\.[][a-z0-9:;&#@=_~%\?\/\.\,\+\-]+)";
        $regex[email] = "([a-z0-9_\-]+)@([a-z0-9_\-]+\.[a-z0-9\-\._\-]+)"; 

        //去掉标签之间的文字 
        $string = eregi_replace(">[^<>]+<","><", $string); 

        //去掉JAVASCRIPT代码 
        $string = eregi_replace("<!--.*//-->","", $string); 

        //去掉非<a>的HTML标签 
        $string = eregi_replace("<[^a][^<>]*>","", $string); 

        //去掉EMAIL链接 
        $string = eregi_replace("<a([ ]+)href=([\"']*)mailto:($regex[email])([\"']*)[^>]*>","", $string); 

        //替换需要的网页链接 
        $string = eregi_replace("<a([ ]+)href=([\"']*)($regex[url])([\"']*)[^>]*>","\\3\t", $string); 

        $output[0] = strtok($string, "\t"); 
        while(($temp = strtok("\t"))) 
        { 
            if($temp && !in_array($temp, $output)){
                $output[++$i] = $temp; 
            }
        } 

        return $output; 
    } 
}


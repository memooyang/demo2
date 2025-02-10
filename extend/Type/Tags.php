<?php
/*
\Type\Tags
*/
namespace Type;

class Tags
{
    
    /*
    \Type\Tags::parseToArray();
    */
    public static function parseToArray($tags = ''){
        $arr = [];
        if(empty($tags)){ return $arr; }
        if(strpos($tags, '[{"') !== false){
            $tags = json_decode($tags, true);
            foreach($tags as $tag){
                $arr[] = $tag['value'];
            }
        }else{
            $tags = explode(',', $tags);
            $arr = $tags;
        }
        return $arr;
    }
}
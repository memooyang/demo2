<?php
/*
\Type\Arr
*/
namespace Type;

class Arr
{
    
    /*
    \Type\Arr::hasMatch();
    */
    public static function hasMatch($keys1, $keys2){
        $has = false;
        foreach($keys1 as $key1){
            foreach($keys2 as $key2){
                if($key1 == $key2){
                    $has = true;
                }
            }
        }
        return $has;
    }
    
    public static function sort($arr){
        $len = count($arr);
        $count = 0;
        $bound = $len-1;

        for ($i = 0; $i < $len - 1; $i++) {
            $swapped = false;
            $newBound = 0;
            // 如上所述, 這裡新增了 $j < $bound 邏輯
            // $bound 預設為 $len - 1, 但會隨著最後一次做對調的 index 位置而變化
            // 換言之, 假如上一輪最終對調 index 位置為 5, 那我下一輪開始時
            // 5 之後(含 5) 的 index 我都不需要去比較了
            for ($j = 0; $j < $bound; $j++) {
                $count++;
                if ($arr[$j]['value'] > $arr[$j + 1]['value']) {
                    $tmp = $arr[$j + 1];
                    $arr[$j + 1] = $arr[$j];
                    $arr[$j] = $tmp;
                    $swapped = true;
                    // 這裏更新 $newBound, $newBound 會儲存最後一次有調整的 index
                    $newBound = $j;
                }
            }
            // $bound 會在每一輪的外圈結尾時更新, 代表著上一輪外圈中, index 對調的最後位置
            // 換言之, 該位置往右的皆是已經排序完成的
            $bound = $newBound;
            if(! $swapped) break;
        }
        return $arr;
    }
    
    /*
    @return [YYYY-mm-dd, ....]
    */
    public static function arrayKeyDates($start, $end='now') {
        // can use DateTime::createFromFormat() instead
        $startDate = new \DateTime($start);
        $endDate = new \DateTime($end);

        if ($startDate === false) {
            // invalid start date.
            return;
        }

        if ($endDate === false) {
            // invalid end date.
            return;
        }

        if ($startDate > $endDate) {
            // start date cannot be greater than end date.
            return;
        }

        $dates = array();
        while($startDate <= $endDate) {
            $dates[$startDate->format('Y-m-d')] = 0;
            // $dates[$startDate->format('Y-n-j')] = 0;
            $startDate->modify('+1 day');
        }

        return $dates;
    }
    
    /*
    @return [YYYY-mm, ....]
    */
    public static function arrayKeyDatesForMonth($start, $end='now') {
        // can use DateTime::createFromFormat() instead
        $startDate = new \DateTime($start);
        $endDate = new \DateTime($end);

        if ($startDate === false) {
            // invalid start date.
            return;
        }

        if ($endDate === false) {
            // invalid end date.
            return;
        }

        if ($startDate > $endDate) {
            // start date cannot be greater than end date.
            return;
        }

        $dates = array();
        while($startDate <= $endDate) {
            $dates[$startDate->format('Y-m')] = 0;
            // $dates[$startDate->format('Y-n-j')] = 0;
            $startDate->modify('+1 day');
        }

        return $dates;
    }
    
    /*
    @return [YYYY-mm, ....]
    */
    public static function arrayKeyDatesForMonthDay($start, $end='now') {
        // can use DateTime::createFromFormat() instead
        $startDate = new \DateTime($start);
        $endDate = new \DateTime($end);

        if ($startDate === false) {
            // invalid start date.
            return;
        }

        if ($endDate === false) {
            // invalid end date.
            return;
        }

        if ($startDate > $endDate) {
            // start date cannot be greater than end date.
            return;
        }

        $dates = array();
        while($startDate <= $endDate) {
            $dates[$startDate->format('Y-m-d')] = 0;
            // $dates[$startDate->format('Y-n-j')] = 0;
            $startDate->modify('+1 day');
        }

        return $dates;
    }
    
    /*
    @return [mm-dd H, ....]
    */
    public static function arrayKeyDatesForMonthDayHour($start, $end='now') {
        // can use DateTime::createFromFormat() instead
        $startDate = new \DateTime($start);
        $endDate = new \DateTime($end);

        if ($startDate === false) {
            // invalid start date.
            return;
        }

        if ($endDate === false) {
            // invalid end date.
            return;
        }

        if ($startDate > $endDate) {
            // start date cannot be greater than end date.
            return;
        }

        $dates = array();
        while($startDate <= $endDate) {
            $dates[$startDate->format('m-d H')] = 0;
            // $dates[$startDate->format('Y-n-j')] = 0;
            $startDate->modify('+1 hour');
        }

        return $dates;
    }
    
    /*
    @return [H:i, ....]
    */
    public static function arrayKeyDatesForHourAndEveryMinutes($start, $end='now', $minutes = '10') {
        // can use DateTime::createFromFormat() instead
        $startDate = new \DateTime($start);
        $endDate = new \DateTime($end);

        if ($startDate === false) {
            // invalid start date.
            return;
        }

        if ($endDate === false) {
            // invalid end date.
            return;
        }

        if ($startDate > $endDate) {
            // start date cannot be greater than end date.
            return;
        }

        $dates = array();
        while($startDate <= $endDate) {
            $dates[$startDate->format('H:i')] = 0;
            // $dates[$startDate->format('Y-n-j')] = 0;
            $startDate->modify('+'.$minutes.' minute');
        }

        return $dates;
    }
    
    /*
    @return [H:i, ....]
    */
    public static function arrayKeyDatesForHourAndEvery1Minute($start, $end='now') {
        // can use DateTime::createFromFormat() instead
        $startDate = new \DateTime($start);
        $endDate = new \DateTime($end);

        if ($startDate === false) {
            // invalid start date.
            return;
        }

        if ($endDate === false) {
            // invalid end date.
            return;
        }

        if ($startDate > $endDate) {
            // start date cannot be greater than end date.
            return;
        }

        $dates = array();
        while($startDate <= $endDate) {
            $dates[$startDate->format('H:i')] = 0;
            // $dates[$startDate->format('Y-n-j')] = 0;
            $startDate->modify('+1 minute');
        }

        return $dates;
    }
    
    /*
    @return [H:i, ....]
    */
    public static function arrayKeyDatesForRecent1HourMinutes($start, $end='now') {
        // can use DateTime::createFromFormat() instead
        $startDate = new \DateTime($start);
        $endDate = new \DateTime($end);

        if ($startDate === false) {
            // invalid start date.
            return;
        }

        if ($endDate === false) {
            // invalid end date.
            return;
        }

        if ($startDate > $endDate) {
            // start date cannot be greater than end date.
            return;
        }

        $dates = array();
        while($startDate <= $endDate) {
            $dates[$startDate->format('H:i')] = 0;
            // $dates[$startDate->format('Y-n-j')] = 0;
            $startDate->modify('+1 minute');
        }

        return $dates;
    }

    /*
    */
    public static function addValueWithExplode($implode_str = '', $value = '')
    {
        $explode_arr = explode(',', $implode_str);
        $arr = $explode_arr;
        $arr[] = $value;
        $arr = array_filter($arr);
        $arr = array_unique($arr);
        return $arr;        
    }
    
    /*
    */
    public static function addValue($explode_arr = array(), $value = '')
    {
        $arr = $explode_arr;
        $arr[] = $value;
        $arr = array_filter($arr);
        $arr = array_unique($arr);
        return $arr;  
    }
    
    /*
    */
    public static function removeValueWithExplode($implode_str = '', $value = '')
    {
        $arr = array();
        $explode_arr = explode(',', $implode_str);
        foreach($explode_arr as $row){
            if($row != $value){
                $arr[] = $row;
            }
        }
        $arr = array_filter($arr);
        $arr = array_unique($arr);
        return $arr;        
    }
    
    /*
    */
    public static function removeValue($explode_arr = array(), $value = '')
    {
        $arr = array();
        foreach($explode_arr as $row){
            if($row != $value){
                $arr[] = $row;
            }
        }
        $arr = array_filter($arr);
        $arr = array_unique($arr);
        return $arr;  
    }
    
    /*
    */
    public static function getIDs($rows = array())
    {
        $arr = array();
        foreach($rows as $row){
            $arr[] = $row['id'];
        }
        $arr = array_filter($arr);
        $arr = array_unique($arr);
        return $arr;        
    }
    
    /*
    */
    public static function filter($arr = array())
    {
        $arr = array_filter($arr);
        $arr = array_unique($arr);
        return $arr;
    }
    
    /*
    
    計算陣列數量
    @param $arr 來源
    @throws 
    @return Int
    
    */
    public static function count($arr)
    {
        if (is_array($arr)){
            $count = count($arr);
            if (!(empty($count))){return $count;}else{return 0;}
        }else{
            return 0;
        }
    }
    
    /*
    
    Search to array by value
    @param $record_array 來源
    @param Int $count
    @param Boolean $is_fill_array 若陣列不足是否填滿陣列
    @throws 
    @return Array
    
    */
    public static function getValueByKeyForArray($arr, $key)
    {
        if(empty($arr)){ return array(); }
        if(empty($key)){ return array(); }
        $_arr = array();
        foreach($arr as $row){
            $_arr[] = $row[$key];
        }
        return $_arr;
    }
    /*
    
    Search to array by value
    */
    public static function searchToValue($key, $array, $trueValue='', $falseValue='')
    {
        if(array_search($key, $array) === false){
            return $falseValue;
        }else{
            return $trueValue;
        }
    }
    
    /*
    Search to array by value
    */
    public static function search($key, $array, $trueValue='1', $falseValue='0')
    {
        if(array_search($key, $array) === false){
            return $falseValue;
        }else{
            return $trueValue;
        }
    }
    
    /*
    
    POP陣列至新陣列 BY COUNT
    @param $record_array 來源
    @param Int $count
    @param Boolean $is_fill_array 若陣列不足是否填滿陣列
    @throws 
    @return Array
    
    */
    public static function shiftToArray(&$record_array, $count = 1, $is_fill_array = false)
    {
        if(empty($count)){ return array(); }
        $arr = array();
        if(is_array($record_array)){
            for($i=0;$i<$count;$i++){
                $r = array_shift($record_array);
                if($r || $is_fill_array){
                    $arr[] = $r;
                }else{
                    break;
                }
            }
        }
        return $arr;
    }
    /*
    
    POP陣列至新陣列 BY COUNT
    @param $record_array 來源
    @param Int $count
    @throws 
    @return Array
    
    */
    public static function popToArray(&$record_array, $count = 1)
    {
        if(empty($count)){ return array(); }
        $arr = array();
        if(is_array($record_array)){
            for($i=0;$i<$count;$i++){
                $arr[] = array_pop($record_array);
            }
        }
        return $arr;
    }
    /*
    
    驗證為空白則不列入陣列
    @param $record_array 來源
    @param $data_name KEY
    @param $data_value VALUE
    @throws 
    @return Boolean
    
    */
    public static function push(&$record_array, $data_name, $data_value, $allow_null = false)
    {
        if ($data_value != null || $data_value != ''){ $record_array[$data_name] = $data_value; return true; }
        if ($allow_null){ if ($data_value == null || $data_value == ''){ $record_array[$data_name] = ''; return true; } }
        return false;
    }
    
    /*
    
    解析序列化陣列為正規化陣列值 VALUE
    @param Array $src 
    @throws 
    @return Array
    */
    public static function parseSerializeArrayOnlyValue($src)
    {
        if(empty($src)){ return array(); }
        $arr = array();
        foreach($src as $row){
            $arr[] = $row['value'];
        }
        return $arr;
    }
    /*
    
    解析序列化陣列為正規化陣列值 KEY => VALUE
    @param Array $src 
    @throws 
    @return Array
    */
    public static function parseSerializeArray($src)
    {
        if(empty($src)){ return array(); }
        $arr = array();
        foreach($src as $row){
            $arr[$row['name']] = $row['value'];
        }
        return $arr;
    }
    /*
    
    置換KEY字串
    @param String $symbol 
    @param String $replace 
    @param Array $src 
    @param Array $options 
    @throws 
    @return Array
    */
    public static function replaceKey($symbol, $replace, $src, $options = array())
    {
        $arr = array();
        foreach($src as $key => $value){
            $k = str_replace($symbol, $replace, $key);
            $arr[$k] = $value;
        }
        // if(empty($src)){ return array(); }
        // //INIT
        // $field_key = 'name';
        // $field_value = 'value';
        
        // if($options['key']){ $field_key = $options['key']; }
        
        // $arr = array();
        // foreach($src as $row){
            // $k = str_replace($symbol, $replace, $row[$field_key]);
            // $arr[$k] = $row[$field_value];
        // }
        return $arr;
    }
    
    /*
    解析分隔符號 String => Array
    */
    public static function explode($str, $symbol=null)
    {
        if(empty($str)){ return array(); }
        if(empty($symbol)){ $symbol = ','; }
        $arr = explode($symbol, $str);
        $arr = array_filter($arr);
        return $arr;
    }
    
    /*
    解析分隔符號 String => Array
    */
    public static function explodeAndUnique($str, $symbol=null)
    {
        if(empty($str)){ return array(); }
        if(empty($symbol)){ $symbol = ','; }
        $arr = explode($symbol, $str);
        $arr = array_filter($arr);
        $arr = array_unique($arr);
        return $arr;
    }
    
    /*
    取得陣列值為字串
    */
    public static function implodeToString($arr, $size=0, $symbol=null)
    {
        if(!(is_array($arr))){ return $arr; }
        if(empty($symbol)){ $symbol = ''; }
        $arr_new = array();
        if($size > 0){
            $c = 0;
            foreach($arr as $row){
                $c++;
                $arr_new[] = $row;
                if($c >= $size){ break; }
            }
        }
        $str = implode(
            $symbol,
            $arr_new
        );
        return $str;
    }
    
    /*
    原陣列 => 子陣列 BY 長度
    @example
    array(1,2,3,4) / $len_nested_array=2
    to
    array(array(1,2), array(3,4))

    @DOC
    array_chunk($arr, 2, true)

    */
    // public static function splitToNestedChildArray($arr, $len_nested_array=2)
    // {
    //     $_arr = array();

    //     $t = count($arr);
    //     $b = bcdiv($t \ $len_nested_array)+1;

    //     for($i = 0; $i < $b; $i++){
    //         $_temp = array();
    //         for($j = 0; $j < $len_nested_array; $j++){
    //             $_temp[] = array_shift($arr);
    //         }
    //         $_arr[] = $_temp;
    //     }
    //     return $_arr;
    // }
    
    /*
    兩個KEY值ARRAY是否相同

    */
    public static function isMatch($arr1 = array(), $arr2 = array())
    {
        if(empty($arr1) && empty($arr2)){ return true; }
        if(!is_array($arr1)){ return false; }
        if(!is_array($arr2)){ return false; }
        //FROM DB
        $_is_match = true;
        //FROM CLIENT
        // $_arr2_cart_product_no = array();
        foreach($arr2 as $row){
            if(array_search($row, $arr1) === false){
                $_is_match = false;
            }
        }
        return $_is_match;
    }


}
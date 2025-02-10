<?php
/*
\Type\Str
*/
namespace Type;

class Str
{
    
    /*
    @use
        \Type\Str::domain();
    @return 
        www.domain.com
    */
    public static function domain($url = ''){
        if(empty($url)){ return ''; }
        $v = str_replace('https://', '', $url);
        $v = str_replace('http://', '', $v);
        $v = explode('/', $v);
        $v = array_shift($v);
        return $v;
    }
    
    /*
    @use
        \Type\Str::host();
    @return 
        https://www.domain.com
    */
    public static function host($url = ''){
        if(empty($url)){ return ''; }
        $v = self::domain($url);
        $v = "https://{$v}";
        return $v;
    }
    
    /**
    * 將Month
    * @param int $unicode
    * @return string UTF-8字元
    @use
    \Type\Str::to02d();
    **/
    public static function date_ym($year, $month){
        $format = '%04d-%02d';
        $str = sprintf($format, $year, $month);
        return $str;
    }
    
    /**
    * 將Month
    * @param int $unicode
    * @return string UTF-8字元
    @use
    \Type\Str::to02d();
    **/
    public static function to02d($str){
        $format = '%02d';
        $str = sprintf($format, $str);
        return $str;
    }

    /**
    * 將unicode轉換成字元
    * @param int $unicode
    * @return string UTF-8字元
    **/
    public static function unicode2Char($unicode){
        if($unicode < 128) return chr($unicode);
        if($unicode < 2048) return chr(($unicode >> 6) + 192) .
                                   chr(($unicode & 63) + 128);
        if($unicode < 65536) return chr(($unicode >> 12) + 224) .
                                    chr((($unicode >> 6) & 63) + 128) .
                                    chr(($unicode & 63) + 128);
        if($unicode < 2097152) return chr(($unicode >> 18) + 240) .
                                      chr((($unicode >> 12) & 63) + 128) .
                                      chr((($unicode >> 6) & 63) + 128) .
                                      chr(($unicode & 63) + 128);
        return false;
    }

    /**
    * 半形轉全形
    * @param string $str
    * @return string
    示例代碼：

    $a = 'abc12 345';
    $sbc = dbc2Sbc($a);
    $dbc = sbc2Dbc($sbc);
     
    var_dump($a, $sbc, $dbc);
    結果：

    string(9) "abc12 345"
    string(27) "ａｂｃ１２　３４５"
    string(9) "abc12 345"
    **/
    public static function dbc2Sbc($str){
        return preg_replace(
            // 半形字元 
            '/[\x{0020}\x{0020}-\x{7e}]/ue',  
            // 編碼轉換
            // 0x0020是空格，特殊處理，其他半形字元編碼+0xfee0即可以轉為全形
            '($unicode=char2Unicode(\'\0\')) == 0x0020 ? unicode2Char（0x3000） : (($code=$unicode+0xfee0) > 256 ? unicode2Char($code) : chr($code))',
            $str
        );
    }
    
    /**
    * 全形轉半形
    * @param string $str
    * @return string
    **/
    public static function sbc2Dbc($str){
        return preg_replace(
            // 全形字元 
            '/[\x{3000}\x{ff01}-\x{ff5f}]/ue',
            // 編碼轉換
            // 0x3000是空格，特殊處理，其他全形字元編碼-0xfee0即可以轉為半形
            '($unicode=char2Unicode(\'\0\')) == 0x3000 ? " " : (($code=$unicode-0xfee0) > 256 ? unicode2Char($code) : chr($code))',
            $str
        );
    }

    /*
    
    解析資料為HTML符合之格式資料
    
    @param String $src 
    @throws 
    @return String 
    
    */
    public static function plaintext($src, $options = array())
    {
        //line 1 fixes the line breaks - line 2 the slashes
        $src = html_entity_decode($src);
        $src = strip_tags($src);
        $src = str_replace('&nbsp;', ' ', $src);
        return $src;
    }
    
    /*
    
    
    區分大小寫字串比對 
    如果 str1小於 str2則傳回小於零的值；如果 str1大於 str2則傳回大於零的值；若二字串相等則傳回零。
    
    @params String $str1 
    @params String $str2 
    @throws 
    @return Boolean 

    Xs_Helper_String::equal()
    
    */
    public static function equal($str1, $str2)
    {
        $v = strcmp($str1, $str2);
        switch ($v) { 
            case 0:
                return true;
                break;

        }
        return false;
    }
    
    /*
    
    
    不分大小寫字串比對 
    如果 str1小於 str2則傳回小於零的值；如果 str1大於 str2則傳回大於零的值；若二字串相等則傳回零。
    
    @params String $str1 
    @params String $str2 
    @throws 
    @return Boolean 

    @example
        Xs_Helper_String::equalExculdeCase()
        http://www.php5.idv.tw/modules.php?mod=books&act=show&shid=612
    
    */
    public static function equalExculdeCase($str1, $str2)
    {
        $v = strcasecmp($str1, $str2);
        switch ($v) { 
            case 0:
                return true;
                break;

        }
        return false;
    }
    
    /*
    
    檢查為其比較值時回傳字串 checked
    
    @params String $field_value 
    @params String $compare_value 
    @throws 
    @return String 

    Xs_Helper_Form\Checkbox::toChecked()
    
    */
    public static function toOutput($field_value, $compare_value = null, $output_string = '', $is_default=false)
    {
        if(empty($field_value) && $is_default){ return $output_string; }
        if(!(isset($field_value))){ return; }
        if(!(isset($compare_value))){ return; }
        if ($field_value == $compare_value){ return $output_string; }
        return '';
    }

    /*
    
    搜尋是否含有指定字串
    
    */
    public static function searchFor($srcValue='', $searchBy='')
    {
        $pos = strpos($srcValue, $searchBy);
        if ($pos !== false) {
            return true;
        }else{
            return false;
        }
    }
    /*
    
    解決PHP substr切割中文字問題
    
    */
    public static function substrForUTF8($StrInput, $strStart, $strLen) 
    {
        //對字串做URL Eecode
        $StrInput = mb_substr($StrInput, $strStart, mb_strlen($StrInput));
        $iString = urlencode($StrInput);
        $lstrResult = "";
        $istrLen = 0;
        $k = 0;
        do {
            $lstrChar = substr($iString, $k, 1);
            if ($lstrChar == "%") {
                $ThisChr = hexdec(substr($iString, $k + 1, 2));
                if ($ThisChr >= 128) {
                    if ($istrLen + 3 < $strLen) {
                        $lstrResult .= urldecode(substr($iString, $k, 9));
                        $k = $k + 9;
                        $istrLen += 3;
                    } else {
                        $k = $k + 9;
                        $istrLen += 3;
                    }
                } else {
                    $lstrResult .= urldecode(substr($iString, $k, 3));
                    $k = $k + 3;
                    $istrLen += 2;
                }
            } else {
                $lstrResult .= urldecode(substr($iString, $k, 1));
                $k = $k + 1;
                $istrLen++;
            }
        } while ( $k < strlen ( $iString ) && $istrLen < $strLen);
        return $lstrResult;
    }
    /*
    
    比較 EMPTY 取得字串
    
    */
    public static function compareEmptyForCSS($srcValue='', $trueToStyleName='btn-danger', $falseToStyleName='btn-success')
    {
        if(empty($srcValue)){
            return $falseToStyleName;
        }else{
            return $trueToStyleName;
        }
    }
    /*
    
    比較 並 取得字串
    
    */
    public static function compareEqual($v1='', $v2='', $trueString='', $falseString='')
    {
        if($v1 == $v2){
            return $trueString;
        }else{
            return $falseString;
        }
    }
    /*
    
    計數器格式化
    
    */
    public static function getFormatCounter($datalist)
    {
        $count = strlen(count($datalist));
        $counter = '%0'.$count.'d';
        
        return $counter;
    }
    /*
    
    雙斜線取代
    
    */
    public static function filterURL($str)
    {
        $str = str_replace('http://','',$str);
        $str = str_replace('https://','',$str);
        $str = str_replace('ftp://','',$str);
        
        return $str;
    }
    /*
    
    雙斜線取代
    
    */
    public static function replaceBackslashToSlash($str)
    {
        $str = str_replace('\\','/',$str);
        
        return $str;
    }
    /*
    
    字串以分隔符號區隔, 取第一位
    
    */
    public static function spliteFirst($symbol = ',', $str = null)
    {
        $arr = explode($symbol, $str);
        $data = $arr[0];
        
        return $data;
    }
    /*
    
    字串以分隔符號區隔, 取最後一位
    
    */
    public static function spliteLast($symbol = ',', $str = null)
    {
        $arr = explode($symbol, $str);
        $data = $arr[count($arr)-1];
        
        return $data;
    }
    
    /*
    
    在含有分隔符號的字串中, 加入陣列或字串元素
    
    */
    public static function appendWithSymbol($symbol='|', $src='', $append = null)
    {
        if(empty($symbol)){
            $symbol = ',';
        }
        if(is_string($append)){
            if(empty($src)){ 
                $src = $append; 
            }else{
                $src .= $symbol.$append;
            }
        }else if(is_array($append)){
            if(is_string($src)){ 
                $src = array_filter(explode(
                    $symbol,
                    $src
                ));
            }
            if(!(is_array($src))){ $src = array(); }
            foreach($append as $row){
                $src[] = $row;
            }
            $src = implode($symbol, $src);
        }
        return $src;
    }
    
    /*
    
    改變分隔符號
    
    */
    public static function changeSplitSymbol($array, $symbol=',', $changeSymbol='|')
    {
        if(empty($array)){
            return false;
        }
        $str = explode($symbol, $array);
        $result = implode($changeSymbol, $str);
        return $result;
    }
    
    /*
    
    在含有分隔符號的字串中, 加入陣列或字串元素
    
    */
    public static function getSetFromSet($value = '', $set = '', $symbol=',')
    {
        if(empty($value)){
            return '';
        }
        if(empty($set)){
            return '';
        }
        $array1 = explode($symbol, $set);
        $array2 = array($value);
        // _exit($array1);
        // _exit($array2);
        $result = array_intersect($array1, $array2);
        // _exit($result);
        // $str = implode($symbol, $result);
        return $result;
    }
    
    /*
    
    在含有分隔符號的字串中, 加入陣列或字串元素
    
    */
    public static function getStringSetFromSet($value = '', $set = '', $symbol=',')
    {
        $result = self::getSetFromSet($value, $set, $symbol);
        $result = implode($symbol, $result);
        return $result;
    }
    
    /*
    
    在含有分隔符號的字串中, 加入陣列或字串元素
    
    */
    public static function countSetFromSet($value = '', $set = '', $symbol=',')
    {
        $result = self::getSetFromSet($value, $set, $symbol);
        $count = count($result);
        return $count;
    }
    
    /*
    
    在含有分隔符號的字串中, 加入陣列或字串元素
    
    */
    public static function getInSet($value = '', $array1 = array(), $symbol=',')
    {
        if(empty($value)){
            return 0;
        }
        if(empty($array1)){
            return 0;
        }
        $array2 = array($value);
        $result = array_intersect($array1, $array2);
        $str = implode($symbol, $result);
        return $str;
    }
    
    /*
    
    在含有分隔符號的字串中, 加入陣列或字串元素
    
    */
    public static function findInSet($value = '', $array1 = array(), $symbol=',')
    {
        if(empty($value)){
            return 0;
        }
        if(empty($array1)){
            return 0;
        }
        $array2 = array($value);
        $result = array_intersect($array1, $array2);
        return $result;
    }
    
    /*
    
    在含有分隔符號的字串中, 加入陣列或字串元素
    
    */
    public static function countInSet($value = '', $array1 = array(), $symbol=',')
    {
        $result = self::findInSet($value, $array1, $symbol);
        $count = count($result);
        return $count;
    }
    
    /*
    
    隱碼間隔
    
    */
    public static function maskSpace($str = '', $symbol='*', $unit=2)
    {
        // 每兩位數隱碼
        $unit = 2;

        // 總字數
        $total = mb_strlen($str, 'utf-8');
        if ($total == 0) {
            return $str;
        }

        // 需要隱碼的數量
        $count = ceil($total / $unit);

        // 目前處理到隱碼位數
        $now = 1;

        for ($i = 0; $i < $count; $i++) {
            $head = mb_substr($str, 0, $now - 1, 'utf-8');
            $end = mb_substr($str, $now, $total, 'utf-8');
            $str = $head . $symbol . $end;
            $now = $now + $unit;
        }

        return $str;
    }

    // 隱碼-手機 末4碼為*
    public static function maskFromLast($str, $symbol='*', $count=4)
    {
        // 總字數
        $total = mb_strlen($str, 'utf-8');
        if ($total == 0) {
            return $str;
        }

        // 連續幾碼
        if ($total < $count) {
            $count = $total;
        }

        // 第幾碼開始
        $start = $total - $count + 1;

        for ($i = 0; $i < $count; $i++) {
            $head = mb_substr($str, 0, $start - 1 + $i, 'utf-8');
            $end = mb_substr($str, $start + $i, $total, 'utf-8');
            $str = $head . $symbol .$end;
        }

        return $str;
    }

    public static function truncate($string, $length = 30, $etc = '...', $break_words = false)
    {
        if ($length == 0) return '';
        $string = html_entity_decode(trim(strip_tags($string)) , ENT_QUOTES, 'utf-8');
        for ($i = 0, $j = 0; $i < strlen($string); $i++) {
            if ($j >= $length) {
                for ($x = 0, $y = 0; $x < strlen($etc); $x++) {
                    if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))) , 8, '0', STR_PAD_LEFT) , '0')) {
                        $x+= $number - 1;
                        $y++;
                    }
                    else {
                        $y+= 0.5;
                    }
                }

                $length-= $y;
                break;
            }

            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))) , 8, '0', STR_PAD_LEFT) , '0')) {
                $i+= $number - 1;
                $j++;
            }
            else {
                $j+= 0.5;
            }
        }

        $result = '';
        for ($i = 0; (($i < strlen($string)) && ($length > 0)); $i++) {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))) , 8, '0', STR_PAD_LEFT) , '0')) {
                if ($length < 1.0) {
                    break;
                }

                $result.= substr($string, $i, $number);
                $length-= 1.0;
                $i+= $number - 1;
            }
            else {
                $result.= substr($string, $i, 1);
                $length-= 0.5;
            }
        }

        $result = htmlentities($result, ENT_QUOTES, 'utf-8');
        if ($i < strlen($string)) {
            $result.= $etc;
        }

        return $result;
    }

    /*
    產生會員編號...etc
    @use
        \Type\Str::generateSn(123, 6);
    */
    public static function generateSn($your_sn = 1, $length = 3)
    {
        $sn = sprintf("%0{$length}d", $your_sn);   
        return $sn;
    }

    /*
    產生密碼
    */
    // public static function generateCode($len = 6)
    // {
    //     $pattern = "23456789abcdefghjkmnopqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ";
    //     $serialNum = "";

    //     $len = 6;  //(大寫英文數字亂數6碼)
    //     for ($i = 0; $i < $len; $i++) {
    //         $serialNum .= $pattern{rand(0, 61)};
    //     }

    //     return $serialNum;
    // }

    /*
    產生密碼
    */
    // public static function generatePassword($len = 6)
    // {
    //     $pattern = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    //     $serialNum = "";

    //     $len = 6;  //(大寫英文數字亂數6碼)
    //     for ($i = 0; $i < $len; $i++) {
    //         $serialNum .= $pattern{rand(0, 61)};
    //     }

    //     return $serialNum;
    // }

    /*
    產生密碼 for 忘記密碼之驗證密碼
    */
    // public static function generatePasswordForMailForgetPassword($len = 4)
    // {
    //     $pattern = "0123456789";
    //     $serialNum = "";

    //     $len = 4;  //(大寫英文數字亂數6碼)
    //     for ($i = 0; $i < $len; $i++) {
    //         $serialNum .= $pattern{rand(0, 9)};
    //     }

    //     return $serialNum;
    // }

    // 規則為 (檢核碼)（年份2碼）(活動碼3碼)(大寫英文數字亂數6碼)
    // 檢核碼: X
    // 活動碼: couponId 後三位
    // $activeId 為

    // public static function generateSerialNum($activeId)
    // {
    //     $pattern = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    //     $serialNum = "";
    //     $serialNum .= "B" . // (檢核碼)
    //                   substr(date("Y"), 2) .  // （年份2碼）
    //                   str_pad(substr($activeId, -3), 3, "0",STR_PAD_LEFT);  // (活動碼3碼)

    //     $len = 6;  //(大寫英文數字亂數6碼)
    //     for ($i = 0; $i < $len; $i++) {
    //         $serialNum .= $pattern{rand(0, 61)};
    //     }

    //     return $serialNum;
    // }

    /*
    判斷此字串是不是 UTF-8 
    */
    public static function isUTF8($string)
    {
        return (utf8_encode(utf8_decode($string)) == $string);
    }

    /*
    移除 BOM function
    str_replace("\xef\xbb\xbf", '', $bom_content);
    preg_replace("/^\xef\xbb\xbf/", '', $bom_content);
    */
    public static function removeBOM($str = '')
    {
        if (substr($str, 0,3) == pack("CCC",0xef,0xbb,0xbf))
            $str = substr($str, 3);

        return $str;
    }

    /*
    */
    public static function isFullValidEmail($email){
        // First, we check that there's one @ symbol, and that the lengths are right
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                return false;
            }
        }
        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                    return false;
                }
            }
        }

        return true;
    }
    
    public static function isValidEmail($email)
    {
        if(preg_match("/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $email) > 0){
            return true;
        }else{
            return false;
        }
        return true;
    }
    
    public static function filterForFileName($str)
    {
        $str = preg_replace("/[^a-zA-Z0-9_.-]+/","", $str);
        return $str;
    }
    
    public static function filterSpecialChar($strParam)
    {
        $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
        $str = preg_replace($regex,"",$strParam);
        return $str;
    }
    
    /*
    */
    public static function explode($str = null, $symbol = ',')
    {
        if(empty($str)){ return array(); }
        $arr = explode($symbol, $str);
        $arr = array_filter($arr);
        return $arr;
    }
    
    /*
    */
    public static function explodeAndUnique($str = null, $symbol = ',')
    {
        if(empty($str)){ return array(); }
        $arr = explode($symbol, $str);
        $arr = array_filter($arr);
        $arr = array_unique($arr);
        return $arr;
    }
    
    /*
    */
    public static function explodeAndAppendAndImplode($str = null, $append_str = null, $symbol = ',')
    {
        $arr = explode($symbol, $str);
        $arr[] = $append_str;
        $arr = array_filter($arr);
        $arr = array_unique($arr);
        $str = implode($symbol, $arr);
        return $str;
    }
    
    /*
    */
    public static function explodeAndRemoveAndImplode($str = null, $remove_str = null, $symbol = ',')
    {
        $arr = explode($symbol, $str);
        $arr = array_filter($arr);
        $arr = array_unique($arr);
        $_arr = array();
        foreach($arr as $row){
            if($row != $remove_str){
                $_arr[] = $row;
            }
        }
        $str = implode($symbol, $_arr);
        return $str;
    }
    
    /*
    */
    public static function explodeAndImplode($str = null, $explode_symbol = ',', $implode_symbol = '/')
    {
        $arr = explode($explode_symbol, $str);
        $str = implode($implode_symbol, $arr);
        return $str;
    }
    
    /*
    https://stackoverflow.com/questions/18866571/receive-json-post-with-php
    The decoding might be failing (and returning null) because of php magic quotes.

    If magic quotes is turned on anything read from _POST/_REQUEST/etc. will have special characters such as "\ that are also part of JSON escaped. Trying to json_decode( this escaped string will fail. It is a deprecated feature still turned on with some hosters.

    Workaround that checks if magic quotes are turned on and if so removes them:
    */
    public static function strip_magic_slashes($str) {
        return get_magic_quotes_gpc() ? stripslashes($str) : $str;
    }
    
    public static function decodeJsonForAjaxParam($str) {
        $str = get_magic_quotes_gpc() ? stripslashes($str) : $str;
        $arr = json_decode($str, true);
        return $arr;
    }
    
}
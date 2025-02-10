<?php
/*
\Web\TokenAES256
*/
namespace Web;

class TokenAES256
{
    const KEY = 'xxx';
    const IV = 'xxx';
    
    public static function encode($payload = [], $key = '', $iv = '')
    {
        //-----
        if(empty($key)){ $key = self::KEY; }
        if(empty($iv)){ $iv = self::IV; }
        // _json($key);
        // _json($iv);
        // $hex = bin2hex('Hello world!');
        // _json($hex);
        if(empty($payload)){ return false; }
        $payload = http_build_query($payload);
        $token = bin2hex(openssl_encrypt($payload, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv));
        return $token;
    }
    
    public static function decode($token = '', $key = '', $iv = '')
    {
        //-----
        if(empty($key)){ $key = self::KEY; }
        if(empty($iv)){ $iv = self::IV; }
        $edata1 = self::strippadding(openssl_decrypt(hex2bin($token), "AES-256-CBC", $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv));
        parse_str($edata1, $payload); //參考 demoTradeInfo
        return $payload;
    }

    //去除 padding 副程式
    public static function strippadding($string) {
        $slast = ord(substr($string, -1));
        $slastc = chr($slast);
        $pcheck = substr($string, -$slast);
        if (preg_match("/$slastc{" . $slast . "}/", $string)) {
            $string = substr($string, 0, strlen($string) - $slast);
            return $string;
        } else {
            return false;
        }
    }

    /*
    @demo-edata1 / 解密完成後的TradeInfo
    Status=SUCCESS&Message=%E6%8E%88%E6%AC%8A%E6%88%90%E5%8A%9F&MerchantID=
    MS127874575&Amt=30&TradeNo=23092714215835071&MerchantOrderNo=Vanespl_ec
    _1695795668&RespondType=String&IP=123.51.237.115&EscrowBank=HNCB&Paymen
    tType=CREDIT&RespondCode=00&Auth=115468&Card6No=400022&Card4No=1111&Exp
    =2609&AuthBank=KGI&TokenUseStatus=0&InstFirst=0&InstEach=0&Inst=0&ECI=&
    PayTime=2023-09-27+14%3A21%3A59&PaymentMethod=CREDIT
    
    @parse
    parse_str($edata1, $output);
    
    @return
    {
      "Status": "SUCCESS",
      "Message": "授權成功",
      "MerchantID": "MS152632061",
      "Amt": "30",
      "TradeNo": "24052912522447982",
      "MerchantOrderNo": "Vanespl_ec_1716958326",
      "RespondType": "String",
      "IP": "1.34.48.205",
      "EscrowBank": "HNCB",
      "PaymentType": "CREDIT",
      "RespondCode": "00",
      "Auth": "838910",
      "Card6No": "400022",
      "Card4No": "1111",
      "Exp": "2810",
      "AuthBank": "KGI",
      "TokenUseStatus": "0",
      "InstFirst": "0",
      "InstEach": "0",
      "Inst": "0",
      "ECI": "",
      "PayTime": "2024-05-29 12:52:25",
      "PaymentMethod": "CREDIT"
    }    
    */    
    
    /*
    @test
    http://localhost:8000/test/Newebpay/demoTradeInfo
    http://localhost:8888/test/Newebpay/demoTradeInfo
    */
    public static function demoTradeInfo()
    {
        try{
            $edata1 = 'Status=SUCCESS&Message=%E6%8E%88%E6%AC%8A%E6%88%90%E5%8A%9F&MerchantID= MS127874575&Amt=30&TradeNo=23092714215835071&MerchantOrderNo=Vanespl_ec _1695795668&RespondType=String&IP=123.51.237.115&EscrowBank=HNCB&Paymen tType=CREDIT&RespondCode=00&Auth=115468&Card6No=400022&Card4No=1111&Exp =2609&AuthBank=KGI&TokenUseStatus=0&InstFirst=0&InstEach=0&Inst=0&ECI=& PayTime=2023-09-27+14%3A21%3A59&PaymentMethod=CREDIT';
            parse_str($edata1, $output);
            _json($output);
        }catch(\Exception $e){
        }
    }
}



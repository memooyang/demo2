<?php
/*
\Utils\ExchangeRate
*/
namespace Utils;

class ExchangeRate
{
    
    // any rate to TWD
    public static $var_currency_rate = array(
        'EUR' => '',
        'USD' => '',
        'CNY' => '',
        'HKD' => '',
        'GBP' => '',
    );

    // any rate to CNY
    public static $var_currency_rate_cny = array(
        'EUR' => '',
        'USD' => '',
        'TWD' => '',
        'HKD' => '',
        'GBP' => '',
    );

    // any rate to USD
    public static $var_currency_rate_usd = array(
        'EUR' => '',
        'CNY' => '',
        'TWD' => '',
        'HKD' => '',
        'GBP' => '',
    );

    /*
    */
    public static function doRequestRate($params = array(), $options = array())
    {
        // if(empty($params)){ return false; }
        // if(empty($params['currency'])){ return false; }

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => "http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s={$params['currency']}%3Dx",
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => "",
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 30,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   // CURLOPT_CUSTOMREQUEST => "POST",
        // ));

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);
        // // echo $response;
        // return $response;
    }

    /*
    */
    public static function getSSLPage($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSLVERSION,3); 
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /*
    */
    public static function getRate($from, $to, $YmdH = '')
    {
        $file_name =  "{$from}{$to}.txt";
        if(empty($YmdH)){
            $file_name2 = date('Ymd') . '-' . $file_name;
        }else{
            $file_name2 = $YmdH . '-' . $file_name;
        }

        //TWDUSD.txt
        $file_path = WEB_FILES_PATH . '//rate//' . $file_name;
        $file_path = Helper_String::reduce_double_slashes($file_path);

        //2015123101-TWDUSD.txt
        $file_path2 = WEB_FILES_PATH . '//rate//' . $file_name2;
        $file_path2 = Helper_String::reduce_double_slashes($file_path2);
        
        if (file_exists($file_path2)) {
            $file = fopen($file_path2, "r");
            $data = fread($file, 1024);
            fclose($file);
            // $data = json_decode($data, true);
        }
        if(empty($data)){
            $uri = "https://www.exchangerate-api.com/{$from}/{$to}?k=9b3ec6523778e7bbae8c8a7f";
            // $data = self::getSSLPage($uri);
            // $file = fopen($file_path2, "w");
            // fwrite($file, $data);
            // fclose($file);
            
            if (false !== ($data = @file_get_contents($uri))) {
                $file = fopen($file_path2, "w");
                fwrite($file, $data);
                fclose($file);
            } else {
                // error happened
            }
        }
        if(empty($data)){
            $file = fopen($file_path, "r");
            $data = fread($file, 1024);
            fclose($file);
            return $data;
        }

        //BACKUP
        $file = fopen($file_path, "w");
        fwrite($file, $data);
        fclose($file);

        return $data;
    }

    /*
    STEP 1
    http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=TWDUSD=x
    http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=TWD=x
    http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=USDTWD=x

    http://www.diebiang.com/webdev/_shijiyingyong_shixianshili_tongguoYahoo_APIhuoqushishihuobihuilvdaima_15.html

    //---------
    https://www.exchangerate-api.com/TWD/USD?k=9b3ec6523778e7bbae8c8a7f
    https://www.exchangerate-api.com/TWD/CNY?k=9b3ec6523778e7bbae8c8a7f
    https://www.exchangerate-api.com/CNY/TWD?k=9b3ec6523778e7bbae8c8a7f
    */
    public static function initCurrencyRateToTWD()
    {
        self::$var_currency_rate['EUR'] = self::getRate('EUR', 'TWD');
        self::$var_currency_rate['USD'] = self::getRate('USD', 'TWD');
        self::$var_currency_rate['CNY'] = self::getRate('CNY', 'TWD');
        self::$var_currency_rate['HKD'] = self::getRate('HKD', 'TWD');
        self::$var_currency_rate['GBP'] = self::getRate('GBP', 'TWD');
        
        // $to = 'TWD';
        // $uri = 'http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='; //$uri = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=';   
        // foreach(self::$var_currency_rate as $k => $v){
        //   // $_uri = $uri. $k . $to .'=X';  
        //   // $rate = file_get_contents($_uri);  
        //   $_params = array();
        //   $_params['currency'] = $to;
        //   $rate = self::doRequestRate($_params);
        //   $rate = explode(',', $rate);  
        //   self::$var_currency_rate[$k] = $rate[1];
        // }

        self::$var_currency_rate['TWD'] = 1;
        return self::$var_currency_rate;
    }

    public static function initCurrencyRateToCNY()
    {

        self::$var_currency_rate_cny['TWD'] = self::getRate('TWD', 'CNY');
        self::$var_currency_rate_cny['EUR'] = self::getRate('EUR', 'CNY');
        self::$var_currency_rate_cny['USD'] = self::getRate('USD', 'CNY');
        self::$var_currency_rate_cny['HKD'] = self::getRate('HKD', 'CNY');
        self::$var_currency_rate_cny['GBP'] = self::getRate('GBP', 'CNY');
        // $to = 'CNY';
        // $uri = 'http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='; //$uri = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=';   
        // foreach(self::$var_currency_rate_cny as $k => $v){
        //   // $_uri = $uri. $k . $to .'=X';  
        //   // $rate = file_get_contents($_uri);  
        //   $_params = array();
        //   $_params['currency'] = $to;
        //   $rate = self::doRequestRate($_params); 
        //   $rate = explode(',', $rate);  
        //   self::$var_currency_rate_cny[$k] = $rate[1];
        // }

        self::$var_currency_rate_cny['CNY'] = 1;

        return self::$var_currency_rate_cny;
    }

    public static function initCurrencyRateToUSD()
    {
        self::$var_currency_rate_usd['TWD'] = self::getRate('TWD', 'USD');
        self::$var_currency_rate_usd['EUR'] = self::getRate('EUR', 'USD');
        self::$var_currency_rate_usd['USD'] = self::getRate('CNY', 'USD');
        self::$var_currency_rate_usd['HKD'] = self::getRate('HKD', 'USD');
        self::$var_currency_rate_usd['GBP'] = self::getRate('GBP', 'USD');
        // $to = 'USD';
        // $uri = 'http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='; //$uri = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=';   
        // foreach(self::$var_currency_rate_usd as $k => $v){
        //   // $_uri = $uri. $k . $to .'=X';  
        //   // $rate = file_get_contents($_uri);  
        //   $_params = array();
        //   $_params['currency'] = $to;
        //   $rate = self::doRequestRate($_params);
        //   $rate = explode(',', $rate);  
        //   self::$var_currency_rate_usd[$k] = $rate[1];
        // }

        self::$var_currency_rate_usd['USD'] = 1;

        return self::$var_currency_rate_usd;
    }

    /*
    STEP 2
    捉取幣別有美金/歐元/台幣 轉換成台幣
    @params $from "CNY"
    @return $price "TWD"
    */
    public static function computeCurrencyByRateToTWD($value = '0', $from = '', $scale = 8)
    {
        if(empty($from)){ return false; }
        if(empty(self::$var_currency_rate[$from])){
            self::$var_currency_rate = self::initCurrencyRateToTWD();
        }
        $rate = self::$var_currency_rate[$from];
        $price = bcmul($rate, $value, $scale);
        return $price;
    }

    /*
    捉取幣別有美金/歐元/台幣 轉換成人民幣
    @params $from "TWD"
    @return $price "CNY"
    */
    public static function computeCurrencyByRateToCNY($value = '0', $from = '', $scale = 8)
    {
        if(empty($from)){ return false; }
        if(empty(self::$var_currency_rate_cny[$from])){
            self::$var_currency_rate_cny = self::initCurrencyRateToCNY();
        }
        $rate = self::$var_currency_rate_cny[$from];
        $price = bcmul($rate, $value, $scale);
        return $price;
    }

    /*
    捉取幣別有人民幣/歐元/台幣 轉換成美元
    @params $from "TWD"
    @return $price "CNY"
    */
    public static function computeCurrencyByRateToUSD($value = '0', $from = '', $scale = 8)
    {
        if(empty($from)){ return false; }
        if(empty(self::$var_currency_rate_usd[$from])){
            self::$var_currency_rate_usd = self::initCurrencyRateToUSD();
        }
        $rate = self::$var_currency_rate_usd[$from];
        $price = bcmul($rate, $value, $scale);
        return $price;
    }

    /*
    STEP 3
    台幣費用 (INT)
    @params $from "CNY"
    @return $price "TWD"
    */
    public static function outputFinalPrice($value = '0', $from = '', $scale = 8)
    {
        $price = self::computeCurrencyByRateToTWD($value, $from, $scale);
        $price = floor($price);
        return $price;
    }

}


<?php
/*
\Utils\Captcha\Image
*/
namespace Utils\Captcha;

class Image
{
	/**
     * 生成圖像驗證碼
     * @static
     * @access public
     * @param string $length  位數
     * @param string $mode  類型
     * @param string $type 圖像格式
     * @param string $width  寬度
     * @param string $height  高度
     * @return string
     * @throws ThinkExecption
     */
    public static function generate(&$container, $length=5,$mode=1,$type='png',$width=60,$height=25)
    {
        $randval = self::rand_string($length,$mode);

        $container = $randval;
        // $authCode = new Web\Session_Namespace('Auth_Code');
        // $authCode->imagecode = $randval;

        //$_SESSION['Auth_Code']['imagecode'];
        $_SESSION['SESSION_CAPTCHA_IMAGE'] = $randval;

        $width = ($length*9+10)>$width?$length*9+10:$width;
        if ( $type!='gif' && function_exists('imagecreatetruecolor')) {
            $im = @imagecreatetruecolor($width,$height);
        }else {
            $im = @imagecreate($width,$height);
        }
        $r = Array(225,255,255,223);
        $g = Array(225,236,237,255);
        $b = Array(225,236,166,125);
        $key = mt_rand(0,3);

        $backColor = imagecolorallocate($im, $r[$key],$g[$key],$b[$key]);    //背景色（隨機）
        $borderColor = imagecolorallocate($im, 100, 100, 100);                    //邊框色
        $pointColor = imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));                 //點顏色

        @imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);
        @imagerectangle($im, 0, 0, $width-1, $height-1, $borderColor);
        $stringColor = imagecolorallocate($im,mt_rand(0,200),mt_rand(0,120),mt_rand(0,120));
        // 干擾
        for($i=0;$i<10;$i++){
            $fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagearc($im,mt_rand(-10,$width),mt_rand(-10,$height),mt_rand(30,300),mt_rand(20,200),55,44,$fontcolor);
        }
        for($i=0;$i<25;$i++){
            $fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$pointColor);
        }

        @imagestring($im, 5, 5, 3, $randval, $stringColor);
        self::output($im,$type);
    }

    // 更複雜的驗證碼
    public static function generate2(&$container, $length=4,$type='png',$width=180,$height=60,$fontface='fpnf.ttf',$verifyName='verify') {
        $code =	self::rand_string($length,4);
        $width = ($length*25)>$width?$length*25:$width;
        
        $container = $randval;
        // $authCode = new Web\Session_Namespace('Auth_Code');
        // $authCode->imagecode = $randval;

        //$_SESSION['Auth_Code']['imagecode'];
        
        $im=imagecreatetruecolor($width,$height);
        $borderColor = imagecolorallocate($im, 100, 100, 100);                    //邊框色
        $bkcolor=imagecolorallocate($im,250,250,250);
        imagefill($im,0,0,$bkcolor);
        @imagerectangle($im, 0, 0, $width-1, $height-1, $borderColor);
        // 干擾
        for($i=0;$i<15;$i++){
            $fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagearc($im,mt_rand(-10,$width),mt_rand(-10,$height),mt_rand(30,300),mt_rand(20,200),55,44,$fontcolor);
        }
        for($i=0;$i<255;$i++){
            $fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$fontcolor);
        }
        if(!is_file($fontface)) {
            $fontface = dirname(__FILE__)."/".$fontface;
        }
        for($i=0;$i<$length;$i++){
            $fontcolor=imagecolorallocate($im,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120)); //這樣保證隨機出來的顏色較深。
            $codex= substr($code,$i,1);
            imagettftext($im,mt_rand(16,20),mt_rand(-60,60),40*$i+20,mt_rand(30,35),$fontcolor,$fontface,$codex);
        }
        self::output($im,$type);
    }
    public static function output($im,$type='png')
    {
        header("Content-type: image/".$type);
        $ImageFun='Image'.$type;
        $ImageFun($im);
        imagedestroy($im);
    }

    /**
     * 產生隨機字串，可用來自動生成密碼 預設長度6位元 字母和數位混合
     * @param string $len 長度
     * @param string $type 字串類型
     * 0 字母 1 數位 其它 混合
     * @param string $addChars 額外字元
     * @return string
     */
    public static function rand_string($len=6,$type='',$addChars='') 
    {
        $str ='';
        switch($type) {
            case 0:
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars;
                break;
            case 1:
                $chars= str_repeat('0123456789',3);
                break;
            case 2:
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars;
                break;
            case 3:
                $chars='abcdefghijklmnopqrstuvwxyz'.$addChars;
                break;
            default :
                // 預設去掉了容易混淆的字元oOLl和數位01，要添加請使用addChars參數
                $chars='ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
                break;
        }
        if($len>10 ) {//位元數過長重複字串一定次數
            $chars= $type==1? str_repeat($chars,$len) : str_repeat($chars,5);
        }
    	if($type!=4) {
    		$chars   =   str_shuffle($chars);
    		$str     =   substr($chars,0,$len);
    	}else{
    		// 中文隨機字
    		for($i=0;$i<$len;$i++){
    		  $str.= substr($chars, floor(mt_rand(0,mb_strlen($chars,'utf-8')-1)),1);
    		}
    	}
        return $str;
    }

}

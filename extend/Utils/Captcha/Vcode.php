<?php
/*
\Utils\Captcha\Image
*/
namespace Utils\Captcha;

class Vcode
{
    /*

    */
    public function generateVcode()
    {
        //定義header，聲明圖片文件，最好是png，無版權之擾;
        //生成新的四位整數驗證碼
        //---------------------session_start();//開啟session;
        $vcode = '';
        $str = 'abcdefghijkmnpqrstuvwxyz1234567890';
        //定義用來顯示在圖片上的數字和字母;
        $l = strlen($str); //得到字串的長度;
        //循環隨機抽取四位前面定義的字母和數字;
        for($i=1;$i<=4;$i++)
        {
            $num=rand(0,$l-1);
            //每次隨機抽取一位數字;從第一個字到該字串最大長度,
            //減1是因為截取字符是從0開始起算;這樣34字符任意都有可能排在其中;
            $vcodes.= $str[$num];
            //將通過數字得來的字符連起來一共是四位;
        }
        //---------------------session_register("VCODE");
        //----------$_SESSION['VCODE'] = $vcode;
        //用session來做驗證也不錯;注冊session,名稱為VCODE,
        //其它頁面只要包含了該圖片
        //即可以通過$_SESSION["VCODE"]來調用
        //生成驗證碼圖片，
        srand((double)microtime()*1000000);
        $im = imagecreate(50,20);//圖片寬與高;
        //主要用到黑白灰三種色;
        $black = ImageColorAllocate($im, 0,0,0);
        $white = ImageColorAllocate($im, 255,255,255);
        $gray = ImageColorAllocate($im, 200,200,200);
        //將四位整數驗證碼繪入圖片
        imagefill($im,68,30,$gray);
        //如不用干擾線，注釋就行了;
        $li = ImageColorAllocate($im, 220,220,220);
        for($i=0;$i<3;$i++)
        {//加入3條干擾線;也可以不要;視情況而定，因為可能影響用戶輸入;
            imageline($im,rand(0,30),rand(0,21),rand(20,40),rand(0,21),$li);
        }
        //字符在圖片的位置;
        imagestring($im, 5, 8, 2, $vcodes, $white);
        for($i=0;$i<90;$i++)
        {//加入干擾象素
            imagesetpixel($im, rand()%70 , rand()%30 , $gray);
        }
        header("Pragma:no-cache\r\n");
        header("Cache-Control:no-cache\r\n");
        header("Expires:0\r\n");
        header("content-type:image/PNG\r\n");
        ImagePNG($im);
        ImageDestroy($im);

        return $vcodes;
    }
    public function generateVcode2()
    {
        $im = imagecreate(44,18);
        $back = ImageColorAllocate($im, 245,245,245);
        imagefill($im,0,0,$back); //背景

        srand((double)microtime()*1000000);
        //4位數字
        for($i=0;$i<4;$i++){
            $font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
            $authnum=rand(1,9);
            $vcodes.=$authnum;
            imagestring($im, 5, 2+$i*10, 1, $authnum, $font);
        }
        //加入干擾像素
        for($i=0;$i<100;$i++) 
        {
            $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
            imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
        }
        header("Pragma:no-cache\r\n");
        header("Cache-Control:no-cache\r\n");
        header("Expires:0\r\n");
        header("content-type:image/PNG\r\n");
        ImagePNG($im);
        ImageDestroy($im);

        //$_SESSION['VCODE'] = $vcodes;
        //$namespace->vocde = $vcodes;
        return $vcodes;
    }

    /*
    輸出驗證碼
    @return string
    */
    public function create(){
        if (!function_exists("imagecreate")){
            return false;
        }
        $this->generateVcode();
    }
    
    public function generateText($length=4,$mode=0)
    {
        $randval = $this->getRandomString($length,$mode);
        return $randval;
    }

    public function getRandomString($len=6,$type=0,$addChars='') {
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
                $chars='ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
                break;
        }
        //位數過長重複字符串一定次數
        if($len>10 ) {
            $chars= $type==1? str_repeat($chars,$len) : str_repeat($chars,5);
        }
    	if($type!=4) {
    		$chars = str_shuffle($chars);
    		$str = substr($chars,0,$len);
    	}else{
            //中文隨機
    		for($i=0;$i<$len;$i++){
    		  $str.= substr($chars, floor(mt_rand(0,mb_strlen($chars,'utf-8')-1)),1);
    		}
    	}
        return $str;
    }
}
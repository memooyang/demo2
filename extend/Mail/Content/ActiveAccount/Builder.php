<?php
/*
\Mail\Content\ActiveAccount\Builder
*/
namespace Mail\Content\ActiveAccount;

class Builder extends \Mail\Content\Builder
{
    public function doProcess()
    {
    	//-----
        $dataWeb = $this->instance['dataWeb']??'';
        $objUser = $this->instance['objUser']??'';
        if(empty($dataWeb)){ throw new \Exception('沒有資訊'); }
        if(empty($objUser)){ throw new \Exception('沒有用戶'); }
        $web_id = $dataWeb['id'];
        $web_name = $dataWeb['name']??'';
        $user_id = $objUser['id'];
        
        //-----
        if(empty($this->subject)){
            $subject = "【{$web_name}】：驗證及啟用帳戶";
            if(empty($subject)){ throw new \Exception('沒有主旨'); }
        	$this->subject = trim($subject);
        }
        
        //-----
        if(empty($this->content)){
            $payload = [];
            $payload['web_id'] = $web_id;
            $payload['user_id'] = $user_id;
            $token = \Web\Params::encode($payload);
            // _json($token);
            $params = [];
            $params['web_name'] = $web_name;
            $params['subject'] = $this->subject;
            $params['url'] = "https://{$dataWeb['domain']}/ClientApi/Index/ActiveAccount/{$token}";
            $this->content = \Mail\Content\ActiveAccount\Html::html($params);
        }
        
    	//-----
        $this->result = [];
        $this->result['subject'] = $this->subject;
        $this->result['content'] = $this->content;
        return $this->result;
    }
}
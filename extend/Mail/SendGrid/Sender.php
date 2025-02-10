<?php
/*
\Mail\SendGrid\Sender
*/
namespace Mail\SendGrid;

class Sender extends \Mail\Sender
{
    public function doProcess()
    {
    	//-----
    	$this->result = [];
    	$this->result['status'] = 'error';
    	$this->result['message'] = '';
    	
    	//-----
        $api_key = \Env::get('SENDGRID_TATA_API_KEY');
        $from_mail = \Env::get('SENDGRID_TATA_FROM_MAIL');
        $from_name = \Env::get('SENDGRID_TATA_FROM_NAME');
        if(empty($api_key)){ throw new \Exception('NO API KEY'); }
        if(empty($from_mail)){ throw new \Exception('沒有設定來源Email'); }
        if(empty($from_name)){ throw new \Exception('沒有設定來源Name'); }
        if(\Validator\Email::check($from_mail, true) == false){ throw new \Exception('EMAIL格式不正確'); }
        
    	//-----
    	$to_email = $this->params['to_email']??'';
    	$to_name = $this->params['to_name']??'';
        if(empty($to_email)){ throw new \Exception('沒有設定對象Email'); }
        if(empty($to_name)){ throw new \Exception('沒有設定對象Name'); }
        if(\Validator\Email::check($to_email, true) == false){ throw new \Exception('EMAIL格式不正確'); }
        
    	//-----
    	$subject = $this->params['subject']??'';
    	$content = $this->params['content']??'';
        if(empty($subject)){ throw new \Exception('沒有主旨'); }
        if(empty($content)){ throw new \Exception('沒有內容'); }
    	
    	//-----
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom($from_mail, $from_name);
        $email->setSubject($subject);
        $email->addTo($to_email, $to_name);
        // $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent("text/html", $content);
        
        $sendgrid = new \SendGrid($api_key);
        try {
            $response = $sendgrid->send($email);
            if($response->statusCode()){
            	$this->result['status'] = 'success';
            }
        } catch (Exception $e) {
        }
        
        return $this->result;
    }
}
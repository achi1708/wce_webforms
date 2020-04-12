<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as ControllerBase;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mails extends ControllerBase {


    protected $mail;
    protected $host;
    protected $smtpAuth;
    protected $smtpU;
    protected $smtpP;
    protected $smtpSec;
    protected $smtpPrt;
    protected $from;
    protected $to;
    protected $subject;
    protected $body;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->host = env('WCE_SMTP_HOST');
        $this->smtpAuth = env('WCE_SMTP_AUTH');
        $this->smtpU = env('WCE_SMTP_U');
        $this->smtpP = env('WCE_SMTP_P');
        $this->smtpSec = env('WCE_SMTP_SEC');
        $this->smtpPrt = env('WCE_SMTP_PRT');
    }
	

    public function enviarMail($type, $body = '', $subject = '')
    {
        switch($type){
            case 'sqrf':
                $this->setContentSQRF($body, $subject);
                break;
            case 'contact':
                break;
        }

        $enviar = $this->sendMail();
    }

    private function setContentSQRF($body = '', $subject = '')
    {
        $this->from = $this->to = env('WCE_SMTP_U');

        if($subject == ''){
            $this->subject = 'Nuevo caso SQRF';
        }else{
            $this->subject = $subject;
        }

        if($body == ''){
            $this->body = 'Revisar nuevo caso creado en base de SQRF';
        }else{
            $this->body = $body;
        }

        return true;
    }

    protected function sendMail()
    {
        try {
            $this->mail->SMTPDebug = 0;
            $this->mail->isSMTP(); 
            $this->mail->Host       = $this->host;
            $this->mail->SMTPAuth   = $this->smtpAuth;
            $this->mail->Username   = $this->smtpU;
            $this->mail->Password   = $this->smtpP;
            $this->mail->SMTPSecure = $this->smtpSec;
            $this->mail->Port       = $this->smtpPrt;  

            $this->mail->setFrom($this->from, 'SQRF_informer');
            $this->mail->addAddress($this->to); 

            $this->mail->isHTML(true); 
            $this->mail->Subject = $this->subject;
            $this->mail->Body    = $this->body;
            $this->mail->AltBody = $this->body;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}

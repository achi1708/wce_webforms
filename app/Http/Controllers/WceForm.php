<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as ControllerBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseWs;
use App\Http\Controllers\Mails;
use App\Models\SQRFData;



class WceForm extends ControllerBase {

	protected $basews;
	protected $sqrfmodel;
    protected $mail;

	public function __construct()
    {
        $this->basews = new BaseWs;
        $this->sqrfmodel = new SQRFData;
        $this->mail = new Mails;
    }

	public function sqrfform()
	{
		$data = array('classbody' => 'sqrf-form');
		return \View::make('sqrf_form')->with('data', $data);
	}

	public function sqrfrequest(Request $request)
	{
		$post = $request->all();

		$validator = Validator::make($request->all(), [
            'requesttype' => 'required',
            'name_person_company' => 'required',
            'address_person_company' => 'required',
            'telephone_person_company' => 'required',
            'email_person_company' => 'required|email',
            'role_person_company' => 'required',
            'represent_for' => 'required',
            'sqrf_subject' => 'required',
            'sqrf_description' => 'required'
        ]);

        if ($validator->fails()) {
            $this->basews->setRespuesta(false, false, 'Error en la validación de sus datos, por favor verifique todos los campos.'); 
        }else{
            if(!isset($post['g-recaptcha-response'])){
                $this->basews->setRespuesta(false, false, 'Creemos que este no es un intento legal de registro SQRF.');  
            }else{
                $check_recaptcha = $this->verifyrecaptcha($post['g-recaptcha-response']);

                if($check_recaptcha){
                    $rset_newsqrf = $this->sqrfmodel->add($post);

                    if(isset($rset_newsqrf['id'])){
                        $send_mail = $this->mail->enviarMail('sqrf', 'Revisar nuevo caso SQRF con id: '.$rset_newsqrf['id']);

                        $this->basews->setRespuesta(true, '¡Se ha recibido su solicitud o mensaje y será atendido oportunamente. Gracias por permitirnos ser mejores conociendo sus inquietudes!', array());
                    }else{
                        $this->basews->setRespuesta(false, false, 'Ha ocurrido un error al intentar tomar su solicitud, por favor comuniquese por vía teléfonica con nosotros al +57 313 895 5200 ó al e-mail info@wanderlustcolombianexperience.com');  
                    }
                } else{
                    $this->basews->setRespuesta(false, false, 'Creemos que este no es un intento legal de registro SQRF.');  
                }   
            }
            
        }

        return $this->basews->response($this->basews->respuesta, 200);
	}

    protected function verifyrecaptcha($recaptcha)
    {
        $agent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36';
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=".env('SCRT_RECAPT')."&response=".$recaptcha;

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);

        
        $html     = curl_exec ( $ch );
        $httpcode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
        
        curl_close($ch);
        
        $html = json_decode($html);

        return $html->success;


    }
}

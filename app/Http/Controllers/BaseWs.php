<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as ControllerBase;

class BaseWs extends ControllerBase {

	private $code = 200;    //codigo respuesta
    private $content_type = "application/json"; //tipo respuesta
    public $respuesta = array(
                        'status' => true,
                        'content' => false,
                        'errors' => array()
                        );

    public function setRespuesta($status, $content, $errors)
    {
        $this->respuesta['status'] = $status;
        $this->respuesta['content'] = $content;
        $this->respuesta['errors'] = $errors;
    }
    
    /****** response ws ********/
    public function response($data,$status){
        $this->code = ($status)?$status:200;
        $this->set_headers();
        echo $this->json($data);
        exit;
    }

    /***** set response headers ********/
    private function set_headers(){
        header("HTTP/1.1 ".$this->code." ".$this->get_status_message());
        header("Content-Type:".$this->content_type);
    }

    /***** get status request ********/
    private function get_status_message(){
        $status = array(
                    100 => 'Continue',  
                    101 => 'Switching Protocols',  
                    200 => 'OK',
                    201 => 'Created',  
                    202 => 'Accepted',  
                    203 => 'Non-Authoritative Information',  
                    204 => 'No Content',  
                    205 => 'Reset Content',  
                    206 => 'Partial Content',  
                    300 => 'Multiple Choices',  
                    301 => 'Moved Permanently',  
                    302 => 'Found',  
                    303 => 'See Other',  
                    304 => 'Not Modified',  
                    305 => 'Use Proxy',  
                    306 => '(Unused)',  
                    307 => 'Temporary Redirect',  
                    400 => 'Bad Request',  
                    401 => 'Unauthorized',  
                    402 => 'Payment Required',  
                    403 => 'Forbidden',  
                    404 => 'Not Found',  
                    405 => 'Method Not Allowed',  
                    406 => 'Not Acceptable',  
                    407 => 'Proxy Authentication Required',  
                    408 => 'Request Timeout',  
                    409 => 'Conflict',  
                    410 => 'Gone',  
                    411 => 'Length Required',  
                    412 => 'Precondition Failed',  
                    413 => 'Request Entity Too Large',  
                    414 => 'Request-URI Too Long',  
                    415 => 'Unsupported Media Type',  
                    416 => 'Requested Range Not Satisfiable',  
                    417 => 'Expectation Failed',  
                    500 => 'Internal Server Error',  
                    501 => 'Not Implemented',  
                    502 => 'Bad Gateway',  
                    503 => 'Service Unavailable',  
                    504 => 'Gateway Timeout',  
                    505 => 'HTTP Version Not Supported');
        return ($status[$this->code])?$status[$this->code]:$status[500];
    }

    /***** print array response in json ********/
    private function json($data){
        return json_encode($data);
    }
}

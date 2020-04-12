<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SQRFData extends Model
{
    /**
     * Table name
     */
    protected $table = 'sqrf_data';
    public $timestamps = false;

    public function add($data)
    {
        $reg = new SQRFData;
        $reg->requerimiento = (isset($data['requesttype'])) ? $data['requesttype'] : NULL;
        $reg->nombre = (isset($data['name_person_company'])) ? $data['name_person_company'] : NULL;
        $reg->direccion = (isset($data['address_person_company'])) ? $data['address_person_company'] : NULL;
        $reg->telefono = (isset($data['telephone_person_company'])) ? $data['telephone_person_company'] : NULL;
        $reg->email = (isset($data['email_person_company'])) ? $data['email_person_company'] : NULL;
        $reg->rol = (isset($data['role_person_company'])) ? $data['role_person_company'] : NULL;
        $reg->representacion = (isset($data['represent_for'])) ? $data['represent_for'] : NULL;
        $reg->asunto = (isset($data['sqrf_subject'])) ? $data['sqrf_subject'] : NULL;
        $reg->mensaje = (isset($data['sqrf_description'])) ? $data['sqrf_description'] : NULL;

        if($reg->save()){
            return $reg;
        }else{
            return false;
        }
    }
}

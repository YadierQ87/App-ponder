<?php

namespace app\models;

use app\controllers\SiteController;

class Respuesta extends \yii\base\Model
{
    public $destinatario, $respuesta,$asunto,$id_ticket;

    public function rules()
    {
        return
            [
                [['destinatario', 'respuesta','asunto','id_ticket'], 'required', 'message' => SiteController::translate('This field is mandatory')],
                ['destinatario', 'email', 'message' => SiteController::translate('This field has an incorrect format')],

            ];
    }
    
    public function attributeLabels()
    {
        return [
            'destinatario' => SiteController::translate('Email'),
            'respuesta' => SiteController::translate('Respuesta'),
            'asunto' => SiteController::translate('Asunto'),
            'id_ticket' => SiteController::translate('Id_ticket'),

        ];
    }
    

}

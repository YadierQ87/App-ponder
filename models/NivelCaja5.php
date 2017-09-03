<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nivel_caja5".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property string $fecha
 * @property integer $notificado
 */
class NivelCaja5 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nivel_caja5';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'fecha', 'notificado'], 'required'],
            [['id_usuario', 'notificado'], 'integer'],
            [['fecha'], 'safe'],
            [['id_usuario'], 'unique']
        ];
    }
    

    /* echos por Michi Ing. (Yadier A.)
    public function get_filtros_str()
    {
       return [
             id LIKE              id_usuario LIKE              fecha LIKE              notificado LIKE         ];
    }


    public function get_filtros_int()
    {
       return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'fecha' => 'Fecha',
            'notificado' => 'Notificado',
        ];       
    }*/

  /* fin de los echos por mi */

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'fecha' => 'Fecha',
            'notificado' => 'Notificado',
        ];
    }
}

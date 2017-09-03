<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nivel_cajas".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property string $fecha
 */
class NivelCajas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nivel_cajas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'fecha'], 'required'],
            [['id_usuario'], 'integer'],
            [['fecha'], 'safe'],
            [['id_usuario'], 'unique']
        ];
    }
    

    /* echos por Michi Ing. (Yadier A.)
    public function get_filtros_str()
    {
       return [
             id LIKE              id_usuario LIKE              fecha LIKE         ];
    }


    public function get_filtros_int()
    {
       return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'fecha' => 'Fecha',
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
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campannas".
 *
 * @property integer $id
 * @property string $nombre_campanna
 * @property string $dia_envio
 * @property string $hora_envio
 * @property string $tipo_tarea
 * @property integer $duracion_dias
 * @property integer $user_creo
 * @property string $fecha_creado
 * @property integer $cantd_repeticiones
 * @property string $ult_fecha_ejecucion
 */
class Campannas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campannas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nombre_campanna', 'dia_envio', 'hora_envio', 'tipo_tarea', 'duracion_dias', 'user_creo', 'fecha_creado', 'cantd_repeticiones', 'ult_fecha_ejecucion'], 'required'],
            [['id', 'duracion_dias', 'user_creo', 'cantd_repeticiones'], 'integer'],
            [['dia_envio', 'hora_envio', 'fecha_creado', 'ult_fecha_ejecucion'], 'safe'],
            [['tipo_tarea'], 'string'],
            [['nombre_campanna'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_campanna' => 'Nombre Campanna',
            'dia_envio' => 'Dia Envio',
            'hora_envio' => 'Hora Envio',
            'tipo_tarea' => 'Tipo Tarea',
            'duracion_dias' => 'Duracion Dias',
            'user_creo' => 'User Creo',
            'fecha_creado' => 'Fecha Creado',
            'cantd_repeticiones' => 'Cantd Repeticiones',
            'ult_fecha_ejecucion' => 'Ult Fecha Ejecucion',
        ];
    }
}

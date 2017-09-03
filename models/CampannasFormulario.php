<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campannas_formulario".
 *
 * @property integer $id
 * @property string $nombre_campanna
 * @property string $dia_envio
 * @property string $hora_envio
 * @property string $tipo_tarea
 * @property integer $duracion_dias
 * @property integer $user_creo
 * @property integer $contenido_publicidad
 * @property string $fecha_creado
 * @property integer $cantd_repeticiones
 * @property integer $id_tb_pagina_captura
 * @property string $ult_fecha_ejecucion
 */
class CampannasFormulario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campannas_formulario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'nombre_campanna', 'tipo_tarea', 'user_creo', 'fecha_creado','id_tb_pagina_captura','contenido_publicidad'], 'required'],
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
            'id_tb_pagina_captura' => 'Pagina Captura',
            'hora_envio' => 'Hora Envio',
            'tipo_tarea' => 'Tipo Tarea',
            'contenido_publicidad' => 'Contenido Publicidad',
            'duracion_dias' => 'Duracion Dias',
            'user_creo' => 'Creado por',
            'fecha_creado' => 'Fecha Creado',
            'cantd_repeticiones' => 'Cantd Repeticiones',
            'ult_fecha_ejecucion' => 'Ult Fecha Ejecucion',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_creo']);
    }

    public function getPaginaCaptura()
    {
        return $this->hasOne(PaginaCaptura::className(), ['id' => 'id_tb_pagina_captura']);
    }

}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "diapos_carrusel".
 *
 * @property string $id
 * @property string $ruta_imagen
 * @property integer $titulo_tam_fuente
 * @property string $titulo_alineacion
 * @property string $titulo_en
 * @property string $titulo_es
 * @property integer $titulo_fr
 * @property integer $titulo_pt
 * @property string $descripcion_tam_fuente
 * @property string $descripcion_alineacion
 * @property string $descripcion_en
 * @property string $descripcion_es
 * @property string $descripcion_fr
 * @property string $descripcion_pt
 */
class DiaposCarrusel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'diapos_carrusel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[/*'ruta_imagen', 'descripcion_tam_fuente', 'titulo_tam_fuente', */'titulo_alineacion', 'descripcion_alineacion'], 'required'],
            [['titulo_tam_fuente', 'descripcion_tam_fuente'], 'integer'],
            [['ruta_imagen'], 'string', 'max' => 150],
            [['titulo_alineacion', 'descripcion_alineacion'], 'string', 'max' => 10],
            [['titulo_en', 'titulo_es', 'titulo_fr', 'titulo_pt'], 'string', 'max' => 250],
            [['titulo_tam_fuente', 'descripcion_tam_fuente'], 'string', 'max' => 2],
            [['descripcion_en', 'descripcion_es', 'descripcion_fr', 'descripcion_pt'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ruta_imagen' => 'Imagen de fondo',
            'titulo_tam_fuente' => 'Tamaño del título',
            'titulo_alineacion' => 'Alineación del título',
            'titulo_en' => 'Título en inglés',
            'titulo_es' => 'Título en español',
            'titulo_fr' => 'Título en francés',
            'titulo_pt' => 'Título en portugués',
            'descripcion_tam_fuente' => 'Tamaño del texto',
            'descripcion_alineacion' => 'Alineación del texto',
            'descripcion_en' => 'Texto en inglés',
            'descripcion_es' => 'Texto en español',
            'descripcion_fr' => 'Texto en francés',
            'descripcion_pt' => 'Texto en portugués',
        ];
    }
}

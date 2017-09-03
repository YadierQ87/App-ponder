<?php

namespace app\models;
use Yii;

/**
 * This is the model class for table "pagina_captura".
 *
 * @property string $id
 * @property string $ruta_imagen_fondo
 * @property integer $titulo_tam_fuente
 * @property string $titulo_alineacion
 * @property string $titulo_en
 * @property string $titulo_es
 * @property string $titulo_fr
 * @property string $titulo_pt
 * @property integer $contenido_tam_fuente
 * @property string $contenido_alineacion
 * @property string $contenido_en
 * @property string $contenido_es
 * @property string $contenido_fr
 * @property string $contenido_pt
 * @property integer $estado
 */
class PaginaCaptura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagina_captura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo_tam_fuente', 'contenido_tam_fuente', 'estado'], 'integer'],
            [['ruta_imagen_fondo'], 'string', 'max' => 150],
            [['titulo_alineacion', 'contenido_alineacion'], 'string', 'max' => 10],
            [['titulo_en', 'titulo_es', 'titulo_fr', 'titulo_pt'], 'string', 'max' => 250],
            [['contenido_en', 'contenido_es', 'contenido_fr', 'contenido_pt'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ruta_imagen_fondo' => 'Ruta Imagen Fondo',
            'titulo_tam_fuente' => 'Titulo Tam Fuente',
            'titulo_alineacion' => 'Titulo Alineacion',
            'titulo_en' => 'Titulo En',
            'titulo_es' => 'Titulo Es',
            'titulo_fr' => 'Titulo Fr',
            'titulo_pt' => 'Titulo Pt',
            'contenido_tam_fuente' => 'Contenido Tam Fuente',
            'contenido_alineacion' => 'Contenido Alineacion',
            'contenido_en' => 'Contenido En',
            'contenido_es' => 'Contenido Es',
            'contenido_fr' => 'Contenido Fr',
            'contenido_pt' => 'Contenido Pt',
            'estado' => 'Estado',
        ];
    }
}

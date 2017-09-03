<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "textos_interfaz".
 *
 * @property string $id
 * @property string $titulo_es
 * @property string $titulo_en
 * @property string $titulo_fr
 * @property string $titulo_pt
 * @property string $contenido_es
 * @property string $contenido_en
 * @property string $contenido_fr
 * @property string $contenido_pt
 */
class TextosInterfaz extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'textos_interfaz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo_es', 'titulo_en', 'titulo_fr', 'titulo_pt', 'contenido_es', 'contenido_en', 'contenido_fr', 'contenido_pt'], 'required'],
            [['titulo_es', 'titulo_en', 'titulo_fr', 'titulo_pt'], 'string', 'max' => 50],
            [['contenido_es', 'contenido_en', 'contenido_fr', 'contenido_pt'], 'string', 'max' => 2000],
            [['titulo_es'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo_es' => 'Título en español',
            'titulo_en' => 'Título en inglés',
            'titulo_fr' => 'Título en francés',
            'titulo_pt' => 'Título en portugués',
            'contenido_es' => 'Contenido en español',
            'contenido_en' => 'Contenido en inglés',
            'contenido_fr' => 'Contenido en francés',
            'contenido_pt' => 'Contenido en portugués',
        ];
    }
}

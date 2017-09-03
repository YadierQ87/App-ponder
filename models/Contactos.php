<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contactos".
 *
 * @property string $id
 * @property string $auth_key
 * @property integer $id_pagina_captura
 * @property string $nombre
 * @property string $email
 * @property integer $estado
 */
class Contactos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contactos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_key'], 'required'],
            [['id_pagina_captura', 'estado'], 'integer'],
            [['auth_key'], 'string', 'max' => 32],
            [['nombre', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auth_key' => 'Auth Key',
            'id_pagina_captura' => 'Id Pagina Captura',
            'nombre' => 'Nombre',
            'email' => 'Email',
            'estado' => 'Estado',
        ];
    }

    public function getIdPaginaCaptura()
    {
        return $this->hasOne(PaginaCaptura::className(), ['id' => 'id_pagina_captura']);
    }


}

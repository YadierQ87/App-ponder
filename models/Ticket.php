<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property string $id
 * @property integer $id_user
 * @property string $asunto
 * @property string $mensaje
 * @property integer $estado
 * @property string $urgencia
 * @property string $fecha
 *
 * @property User $idUser
 */
class Ticket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * @inheritdoc
     */

    public static $id_user;

    public function rules()
    {
        return [
            [['id_user', 'asunto', 'mensaje'], 'required'],
            [['id_user', 'estado'], 'integer'],
            [['fecha'], 'safe'],
            [['asunto'], 'string', 'max' => 250],
            [['mensaje'], 'string', 'max' => 500],
            [['urgencia'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'asunto' => 'Asunto',
            'mensaje' => 'Mensaje',
            'estado' => 'Estado',
            'urgencia' => 'Urgencia',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    public function setAttribute($name, $value) {
        parent::setAttribute($name, $value);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_config".
 *
 * @property string $id
 * @property boolean $activar_log
 * @property boolean $cuenta_paypal
 */
class AppConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activar_log'], 'boolean'],
            ['cuenta_paypal', 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activar_log' => 'Activar trazas de uso',
            'cuenta_paypal' => 'Cuenta de PonderNET en PayPal'
        ];
    }
}

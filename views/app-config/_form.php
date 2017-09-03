<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-config-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'activar_log')->checkbox() ?>
            <?= $form->field($model, 'cuenta_paypal')->textInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Aceptar', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

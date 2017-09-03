<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TextosInterfaz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="textos-interfaz-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'contenido_es')->textarea(['maxlength' => true, 'rows' => '5']) ?>
        <?= $form->field($model, 'contenido_en')->textarea(['maxlength' => true, 'rows' => '5']) ?>
        <?= $form->field($model, 'contenido_fr')->textarea(['maxlength' => true, 'rows' => '5']) ?>
        <?= $form->field($model, 'contenido_pt')->textarea(['maxlength' => true, 'rows' => '5']) ?>
        <div class="form-group">
            <?= Html::submitButton('Aceptar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>

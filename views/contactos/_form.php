<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Contactos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contactos-form">

    <?php $form = ActiveForm::begin(); ?>

   <div class="hidden"> <?= $form->field($model, 'auth_key')->textInput(['value' => '_crgRFGDf889nsahjwyyjxx9990']) ?> </div>

    <?= $form->field($model, 'id_pagina_captura')->dropDownList(ArrayHelper::map(app\models\PaginaCaptura::find()->all(), 'id', 'titulo_es'),['prompt'=>'--Seleccione Pagina Captura--']) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->dropDownList([1=>'Activo',0=>'Inactivo']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

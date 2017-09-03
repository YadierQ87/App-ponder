<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\CampannasFormulario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campannas-formulario-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-6">
        <?= $form->field($model, 'nombre_campanna')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'id_tb_pagina_captura')->dropDownList(ArrayHelper::map(app\models\PaginaCaptura::find()->all(), 'id', 'titulo_es'),['prompt'=>'--Seleccione Pagina Captura--']) ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'tipo_tarea')->dropDownList([ 'Programada' => 'Programada', 'Manual' => 'Manual', 'Inicio' => 'Inicio', ], ['prompt' => '']) ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'dia_envio')->textInput(['class'=>'form-control my-date']) ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'contenido_publicidad')->textarea() ?>
    </div>


    <div class="hidden">
        <?= $form->field($model, 'duracion_dias')->textInput(['value'=>2]) ?>
    </div>
    <div class="hidden">
        <?= $form->field($model, 'user_creo')->textInput(['value'=>Yii::$app->user->identity->getId()]) ?>
    </div>
    <div class="hidden">
        <?= $form->field($model, 'fecha_creado')->textInput(['value'=>date('Y-m-d')]) ?>
    </div>
    <div class="hidden">
        <?= $form->field($model, 'cantd_repeticiones')->textInput(['value'=>2]) ?>
    </div>

    <div class="col-lg-6">
        <?= Html::submitButton($model->isNewRecord ? 'Crear Publicidad' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php   $this->registerJs("
        $(document).ready(function() {
        $('.my-date').datetimepicker({
            format: 'yyyy/mm/dd',
            weekStart: 2,        todayBtn:  1,
		    autoclose: 1,		todayHighlight: 1,
		    startView: 2, minView: 2,
        });
    });
"); ?>
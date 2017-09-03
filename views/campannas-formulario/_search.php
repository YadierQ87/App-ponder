<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CampannasFormularioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campannas-formulario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre_campanna') ?>

    <?= $form->field($model, 'dia_envio') ?>

    <?= $form->field($model, 'hora_envio') ?>

    <?= $form->field($model, 'tipo_tarea') ?>

    <?php // echo $form->field($model, 'duracion_dias') ?>

    <?php // echo $form->field($model, 'user_creo') ?>

    <?php // echo $form->field($model, 'fecha_creado') ?>

    <?php // echo $form->field($model, 'cantd_repeticiones') ?>

    <?php // echo $form->field($model, 'ult_fecha_ejecucion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

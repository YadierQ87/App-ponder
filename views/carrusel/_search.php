<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\DiaposCarruselSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diapos-carrusel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ruta_imagen') ?>

    <?= $form->field($model, 'titulo_tam_fuente') ?>

    <?= $form->field($model, 'titulo_alineacion') ?>

    <?= $form->field($model, 'titulo_en') ?>

    <?php // echo $form->field($model, 'titulo_es') ?>

    <?php // echo $form->field($model, 'titulo_fr') ?>

    <?php // echo $form->field($model, 'titulo_pt') ?>

    <?php // echo $form->field($model, 'descripcion_tam_fuente') ?>

    <?php // echo $form->field($model, 'descripcion_alineacion') ?>

    <?php // echo $form->field($model, 'descripcion_en') ?>

    <?php // echo $form->field($model, 'descripcion_es') ?>

    <?php // echo $form->field($model, 'descripcion_fr') ?>

    <?php // echo $form->field($model, 'descripcion_pt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

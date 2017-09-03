<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaginaCapturaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagina-captura-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ruta_imagen_fondo') ?>

    <?= //$form->field($model, 'titulo_tam_fuente') ?>

    <?= //$form->field($model, 'titulo_alineacion') ?>

    <?= $form->field($model, 'titulo_en') ?>

    <?php // echo $form->field($model, 'titulo_es') ?>

    <?php // echo $form->field($model, 'titulo_fr') ?>

    <?php // echo $form->field($model, 'titulo_pt') ?>

    <?php // echo $form->field($model, 'contenido_tam_fuente') ?>

    <?php // echo $form->field($model, 'contenido_alineacion') ?>

    <?php echo $form->field($model, 'contenido_en') ?>

    <?php // echo $form->field($model, 'contenido_es') ?>

    <?php // echo $form->field($model, 'contenido_fr') ?>

    <?php // echo $form->field($model, 'contenido_pt') ?>

    <?php  echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DiaposCarrusel */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="diapos-carrusel-form">

    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    
     <?php $form = ActiveForm::begin([
         "method" => "post",
         "enableClientValidation" => true,
         "options" => ["enctype" => "multipart/form-data"],
    ]); ?>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'ruta_imagen')->textInput(['id' => 'img-fondo', 'readonly' => 'readonly']) ?>
        </div>
        <div class="col-lg-3">
            <div class="fileUpload btn btn-primary" style="height: 35px; margin-top: 20px;">
                <?= $form->field($model, 'ruta_imagen')->fileInput(['class' => 'upload', 'id' => 'img-upload']) ?>
            </div>
        </div>
    </div>
    
    <br />
    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'titulo_tam_fuente')->dropDownList([6 => '6', 8 => '8', 10 => '10', 12 => '12', 14 => '14', 16 => '16', 18 => '18', 20 => '20'], ['prompt' => $model->getAttributeLabel('titulo_tam_fuente')]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'titulo_alineacion')->dropDownList(['left' => 'A la izquierda', 'center' => 'Al centro', 'right' => 'A la derecha'], ['prompt' => $model->getAttributeLabel('titulo_alineacion')]) ?></div>
    </div>
    
    <div class="row">
        <div class="col-lg-6"><?= $form->field($model, 'titulo_en')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'titulo_es')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'titulo_fr')->textInput() ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'titulo_pt')->textInput() ?></div>
    </div>
    
    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'descripcion_tam_fuente')->dropDownList([6 => '6', 8 => '8', 10 => '10', 12 => '12', 14 => '14', 16 => '16', 18 => '18', 20 => '20'], ['prompt' => $model->getAttributeLabel('descripcion_tam_fuente')]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'descripcion_alineacion')->dropDownList(['left' => 'A la izquierda', 'center' => 'Al centro', 'right' => 'A la derecha'], ['prompt' => $model->getAttributeLabel('descripcion_alineacion')]) ?></div>
    </div>
    
    <div class="row">
        <div class="col-lg-6"><?= $form->field($model, 'descripcion_en')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'descripcion_es')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'descripcion_fr')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'descripcion_pt')->textInput(['maxlength' => true]) ?></div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Agregar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


<script>
    document.getElementById("img-upload").onchange = function () {
        document.getElementById("img-fondo").value = this.value;
    };
</script>
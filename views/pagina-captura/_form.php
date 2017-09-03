<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaginaCaptura */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagina-captura-form">


<?php
 $numeros = array();
 for($i=6; $i < 40; $i++){
     $numeros[] = $i;
 }
?>
    <div class="row container-fluid">
        <?php $form = ActiveForm::begin([
                "method" => "post",
                "enableClientValidation" => true,
                "options" => ["enctype" => "multipart/form-data"],
            ]); ?>

        <div class="col-lg-6"><?= $form->field($model, 'titulo_en')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'titulo_es')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'titulo_fr')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'titulo_pt')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6">
            <input type="file" id="fichero_jpg" name="fichero_jpg">
        </div>
        <div class="col-lg-6"> <?= $form->field($model, 'titulo_tam_fuente')->dropDownList($numeros,[]) ?> </div>
        <div class="col-lg-6"> <?= $form->field($model, 'titulo_alineacion')->dropDownList(['left','center','right']) ?></div>
        <div class="col-lg-6"> <?= $form->field($model, 'contenido_tam_fuente')->dropDownList($numeros,[]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'contenido_alineacion')->dropDownList(['left','center','right']) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'contenido_en')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'contenido_es')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'contenido_fr')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'contenido_pt')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-6"><?= $form->field($model, 'estado')->dropDownList(['1'=>'Publicado','0'=>'Sin Publicar',]) ?></div>

        <div class="col-lg-6">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

<?php //echo $_FILES['PaginaCaptura[ruta_imagen_fondo]']['name'];?>

</div>

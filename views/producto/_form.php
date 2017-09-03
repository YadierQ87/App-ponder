<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin([
         "method" => "post",
         "enableClientValidation" => true,
         "options" => ["enctype" => "multipart/form-data"],
    ]); ?>
    <div class="row">
        <div class="col-lg-5"><?= $form->field($model, 'id_categoria')->dropDownList(ArrayHelper::map(app\models\Categoria::find()->all(), 'id', 'nombre'), ['prompt' => 'Seleccione una categoría']) ?></div>
        <div class="col-lg-7"><?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-5"><?= $form->field($model, 'descripcion')->textarea(['maxlength' => true, 'rows' => '4']) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'precio')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-offset-1 col-lg-3"><?= $form->field($model, 'rebaja')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-5"><?= $form->field($model, 'ruta_imagen')->fileInput() ?></div>
        <div class="col-lg-12">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Agregar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

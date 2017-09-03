<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_user')->hiddenInput(['value' => Yii::$app->user->identity->getId()])->label(false) ?>

    <?= $form->field($model, 'asunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mensaje')->textArea(['rows' => 6,'maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->hiddenInput(['value' => 1])->label(false) ?>

    <?= $form->field($model, 'urgencia')->dropDownList(['Urgente'=>'Urgente','Normal'=>'Normal']) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

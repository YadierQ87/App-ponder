<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CampannasFormulario */

$this->title = 'Update Campannas Formulario: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Campannas Formularios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="campannas-formulario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

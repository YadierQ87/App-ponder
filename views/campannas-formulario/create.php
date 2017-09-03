<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CampannasFormulario */

$this->title = html_entity_decode('Crear Campa&ntilde;as Formulario');
$this->params['breadcrumbs'][] = ['label' => html_entity_decode('Campa&ntilde;as Formularios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campannas-formulario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

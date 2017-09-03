<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TextosInterfaz */

$this->title = 'Editar sección ' . $model->titulo_es;
$this->params['breadcrumbs'][] = ['label' => 'Administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Secciones del sitio', 'url' => ['secciones-sitio']];
$this->params['breadcrumbs'][] = ['label' => $model->titulo_es, 'url' => ['detalles-seccion', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="textos-interfaz-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-seccion', ['model' => $model,]) ?>

</div>

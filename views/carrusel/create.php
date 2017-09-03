<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DiaposCarrusel */

$this->title = 'Agregar diapositiva';
$this->params['breadcrumbs'][] = ['label' => 'Administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Carrusel', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diapos-carrusel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model,]) ?>

</div>

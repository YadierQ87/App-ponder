<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DiaposCarrusel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Carrusel', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diapos-carrusel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que desea eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ruta_imagen',
            'titulo_tam_fuente',
            'titulo_alineacion',
            'titulo_en',
            'titulo_es',
            'titulo_fr',
            'titulo_pt',
            'descripcion_tam_fuente',
            'descripcion_alineacion',
            'descripcion_en',
            'descripcion_es',
            'descripcion_fr',
            'descripcion_pt',
        ],
    ]) ?>

</div>

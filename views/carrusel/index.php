<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DiaposCarruselSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carrusel';
$this->params['breadcrumbs'][] = ['label' => 'Administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diapos-carrusel-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar diapositiva', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'titulo_es',
            'ruta_imagen',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

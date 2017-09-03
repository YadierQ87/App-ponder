<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contactos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contactos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contactos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
           // 'auth_key',
            [
                'attribute' => 'Pagina de Captura',
                'value' => function ($data) {
                    if(is_object($data->idPaginaCaptura))
                        return Html::a($data->idPaginaCaptura->titulo_es, yii\helpers\Url::toRoute(['pagina-captura/view', 'id' => $data->id_pagina_captura]));
                    return Html::label('No tiene pagina de Captura') ;
                },
                'format'=>'html'
            ],
            'nombre',
            'email:email',
            // 'estado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

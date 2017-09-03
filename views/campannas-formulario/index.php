<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CampannasFormularioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Campannas Formularios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campannas-formulario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Campannas Formulario', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Ejecutar Campannas Hoy <i class="fa fa-cogs"></i>', ['ejecutar-script'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombre_campanna',
            'dia_envio',
            //'hora_envio',
            'tipo_tarea',
            // 'duracion_dias',
            [
                'attribute' => 'user_creo',
                'format' => 'raw',
                'value' => function ($data)
                {
                    return Html::a($data->user->nombre.' '.$data->user->apellidos, yii\helpers\Url::toRoute(['user/view', 'id' => $data->user_creo]));
                },
            ],
            //'fecha_creado',
            [
                'attribute' => 'id_tb_pagina_captura',
                'format' => 'raw',
                'value' => function ($data)
                {
                    if(is_object($data->paginaCaptura)){
                        return Html::a($data->paginaCaptura->titulo_es, yii\helpers\Url::toRoute(['pagina-captura/view', 'id' => $data->id_tb_pagina_captura]));
                    }else{
                        return ('<i>No existe pagina de captura asociada</i>');
                    }

                },
            ],
            // 'cantd_repeticiones',
            // 'ult_fecha_ejecucion',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{exec} {update} {view} {delete}  ','header'=>'Acciones',
            'buttons' =>
                [
                    'exec' => function ($url, $model, $key)                        {
                        if(is_object($model->paginaCaptura)){
                            return Html::a('<span class="fa fa-play"></span>', Url::to(['ejecutar', 'id' => $model->id]), ['title'=>'Ejecutar para lista de correo',]);
                        }else{
                            return Html::a('<span class="fa fa-play-circle"></span>', Url::to(['ejecutar', 'id' => $model->id]), ['title'=>'Ejecutar para todos los usuarios',]);
                        }

                    },
                ]
           ],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TextosInterfazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Secciones del sitio';
$this->params['breadcrumbs'][] = ['label' => 'Administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="textos-interfaz-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'titulo_es',
            [
                'attribute' => 'contenido_es',
                'format' => 'raw',
                'value' => function($data)
                {
                    return '<p class = "text-justify">' . nl2br($data->contenido_es) . '</p>';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'buttons' =>
                [
                    'view' => function ($url, $model, $key)
                    {
                        return '<a title="Detalles" href="' . yii\helpers\Url::toRoute(['admin/detalles-seccion', 'id' => $model->id]) . '"><i class = "fa fa-eye"></i></a>';
                    },
                    'update' => function ($url, $model, $key)
                    {
                        return '<a title="Editar" href="' . yii\helpers\Url::toRoute(['admin/editar-seccion', 'id' => $model->id]) . '"><i class = "fa fa-edit"></i></a>';
                    },
                ]
            ],
        ],
    ]); ?>

</div>

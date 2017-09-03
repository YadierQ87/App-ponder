<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ticket', ['createadmin'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'id_user',
            'asunto',
            'mensaje',
            'urgencia',
            'fecha',
            [
                'attribute' => 'Estado',
                'format' => 'raw',
                'value' => function ($data)            {
                    return ($data->estado == 1) ? '<label class="label label-info">Abierto</label>' : '<label class="label label-success">Cerrado</label>';
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete} {close}','header'=>'Acciones',
                'buttons' =>
                    [
                        'close' => function ($url, $model, $key)
                        {
                            return Html::a("<i class='fa fa-ban'></i>",Url::to(['cerraradmin','id'=>$model->id]),['id' => 'actv-view','title'=>'Cerrar']);
                        },
                    ]
            ],
        ],
    ]); ?>

</div>

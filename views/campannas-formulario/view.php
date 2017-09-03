<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CampannasFormulario */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Campannas Formularios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campannas-formulario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre_campanna',
            'dia_envio',
            'hora_envio',
            'tipo_tarea',
            'duracion_dias',
            'user_creo',
            'fecha_creado',
            'cantd_repeticiones',
            'ult_fecha_ejecucion',
        ],
    ]) ?>

</div>

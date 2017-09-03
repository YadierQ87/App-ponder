<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PaginaCaptura */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pagina Capturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagina-captura-view">

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
            'ruta_imagen_fondo',
            'titulo_tam_fuente',
            'titulo_alineacion',
            'titulo_en',
            'titulo_es',
            'titulo_fr',
            'titulo_pt',
            'contenido_tam_fuente',
            'contenido_alineacion',
            'contenido_en',
            'contenido_es',
            'contenido_fr',
            'contenido_pt',
            'estado',
        ],
    ]) ?>

</div>

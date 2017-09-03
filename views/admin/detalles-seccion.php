<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TextosInterfaz */

$this->title = $model->titulo_es;
$this->params['breadcrumbs'][] = ['label' => 'Administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Secciones del Sitio', 'url' => ['secciones-sitio']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="textos-interfaz-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['editar-seccion', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo_es',
            'contenido_es',
            'contenido_en',
            'contenido_fr',
            'contenido_pt',
        ],
    ]) ?>

</div>

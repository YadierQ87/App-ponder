<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AppConfig */

$this->title = 'Configuración general';
$this->params['breadcrumbs'][] = ['label' => 'Administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuración general'), 'url' => ['index']];
?>
<div class="app-config-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'activar_log:boolean',
            'cuenta_paypal'
        ],
    ]) ?>

</div>

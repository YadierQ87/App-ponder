<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pagos */

$this->title = Yii::t('app', 'Actualizar pago ') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pagos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="pagos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
//use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\controllers\SiteController;
use app\models\Producto;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = $titulo;
$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Thanks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['producto/view', 'id' => $id]];
?>

<div class="producto-view">
    <h3> <?= SiteController::translate('course') ?> &raquo; <?= Html::encode($this->title) ?></h3>
</div>

<div class="producto-view">
    <?= SiteController::translate('Name') ?>
    Your transaction has been <?= Html::encode($status) ?>, and a receipt from email <?= Html::encode($correo) ?>.<br>
    Total Amount <?= Html::encode($payment) ?>
    You may log into your account at <a href='https://www.paypal.com'>www.paypal.com</a> to view details of this transaction.<br>

</div>




<?php

use yii\helpers\Url;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->params['breadcrumbs'][] = ['label' => SiteController::translate('Process completed')];
?>

<div class="producto-view">
    <div class="box-item container-fluid row">
    <div class="col-lg-3">&nbsp;</div>
        <div class="col-lg-6">
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>

    <h3><i class="fa fa-thumbs-up fa-th-large"></i> <?= SiteController::translate('Thanks for your registration !!!') ?></h3>
    <?//= $nombre_pagina ?></br>
    <h3><?= SiteController::translate('Process completed') ?></h3>
    <h4>Su correo fue guardado para notificarle de otros cursos o eventos!</h4>
    </div>
        <div class="col-lg-3">&nbsp;</div>
        </div>
</div>

<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\controllers\SiteController;

$this->title = SiteController::translate('About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) . ' ' . Yii::$app->name ?></h1>
    <div class="container">
        <div class="col-lg-12">
            <p class="text-justify">
                <?= Html::label(nl2br($contenido)) ?>
            </p>
        </div>
        <code>Copyright &copy; <?= date('Y') . SiteController::translate(' by ') . Yii::$app->name ?></code>
    </div>
    
</div>

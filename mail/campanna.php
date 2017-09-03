<?php
use yii\helpers\Html;
use app\controllers\SiteController;
$link = Yii::$app->urlManager->createAbsoluteUrl(['producto/index']);
?>
<?= SiteController::translate('Dear user:') ?>
<?= $nombre ?>
<?= $campanna ?>
</br>
<?= $body ?>
</br>
<?= SiteController::translate('Please, follow the link to view more info at Pondernet:') ?>
<?= Html::a(Html::encode($link), $link) ?>

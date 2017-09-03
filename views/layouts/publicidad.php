<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;


AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="/App/web/assets/sitio/imagenes/varias/icono_app.png" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" type="text/css" id="SL_Style" href="/App/web/assets/sitio/css/translator.css">
    <style type="text/css">
        .crear:hover {background-color: #285e8e !important;}
    </style>
    <?php $this->head() ?>
</head>
<style>
    .wrap-img img {
        height: 300px;        width: 300px;        border-radius: 50% !important;        display: inline-block;
        padding: 20px;        border: 3px solid #4C4C4C;
    }
    img {
        vertical-align: middle;
    }
    .widget-box{
        padding-top: 8px;
        border: #4C4C4C dashed 1px;
        background: #EAEAEA;
        -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
        box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);

    }
    .widget-form{
        background: #4C4C4C;        color: white !important;        margin: 5px;        padding: 25px;        margin-bottom: 4px;
    }
    .media_body{

    }
    body{
        margin-top: 50px;
        background: url("assets/sitio/imagenes/varias/bg3.jpg");
        background-repeat: no-repeat;        background-size: 100%;
    }
    .heading h2::before {
        content: "";        border-top: 25px solid transparent;        border-bottom: 25px solid transparent;
        border-left: 25px solid #EAEAEA;        position: absolute;        left: 0;        top: 0;
    }
    .heading h2 {
        height: 45px;        background: #449D44;        padding: 10px 0 0 0;
        position: relative;        width: 100%;        font-size: 25px;
        text-align: center;
        text-decoration: none;        color: #fff;
    }
    .heading h2::after {
        content: "";        border-top: 25px solid transparent;        border-bottom: 25px solid transparent;        border-right: 25px solid #EAEAEA;
        position: absolute;        right: 0;        top: 0;
    }
    .box-item{

    }
</style>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
<?= $content ?>
</div>
</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>

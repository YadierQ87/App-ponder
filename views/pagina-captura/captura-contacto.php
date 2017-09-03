<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\controllers\SiteController;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\PaginaCaptura */

$this->title = $pagina->id;
$this->params['breadcrumbs'][] = ['label' => 'Pagina Capturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= \app\controllers\StaticMembers::MostrarMensajes() ?>

<div class="pagina-captura-view">
    <div class="box-item container-fluid row">
        <div class="col-lg-3">&nbsp;</div>
        <?php
        switch (Yii::$app->session->get('language'))
        {
            case 'en-US':
            {
                $contenido = $pagina->contenido_en;
                $titulo = $pagina->titulo_en;
                break;
            }
            case 'fr-FR':
            {
                $contenido = $pagina->contenido_fr;
                $titulo = $pagina->titulo_fr;
                break;
            }
            case 'pt-PT':
            {
                $contenido = $pagina->contenido_pt;
                $titulo = $pagina->titulo_pt;
                break;
            }
            default:
            {
                $contenido = $pagina->contenido_es;
                $titulo = $pagina->titulo_es;
                break;
            }
        }
        ?>

        <div class="col-lg-6 widget-box row">
            <div class="heading col-lg-12"><h2 class="text-<?= $pagina->titulo_alineacion ?>"><?= $titulo ?> </h2></div>
            <div class="row container-fluid">
                <!-- aqui la imagen y el texto -->
                <div class="col-lg-6">
                    <div class="wrap-img">
                        <img src="<?= $pagina->ruta_imagen_fondo ?>" alt="Pagina de Captura" width="350px" height="350px" style="margin-bottom:10px "/>
                    </div>
                    <div class="media_body">
                        <h2><?= $contenido ?></h2>
                        <a class="btn btn-3" href="#"><i class="fa fa-chevron-right"></i> View More</a>
                    </div>
                </div>
                <!-- aqui el formulario de contacto -->
                <div class="col-lg-6">
                    <div class="widget-form">
                        <h3 style="text-align: center"><?= SiteController::translate('Information Contact')?></h3>
                        <i><?= SiteController::translate('Please fill the information above to receive notification about')?></i>
                        <?php $form = ActiveForm::begin(); ?>

                        <div class="hidden"> <?= $form->field($model, 'auth_key')->textInput(['value' => '_crgRFGDf889nsahjwyyjxx9990']) ?> </div>

                        <div class="hidden"> <?= $form->field($model, 'id_pagina_captura')->textInput(['value'=>$pagina->id]) ?> </div>

                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                        <div class="hidden"> <?= $form->field($model, 'estado')->textInput(['value'=>1]) ?> </div>

                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">&nbsp;</div>
    </div>
</div>

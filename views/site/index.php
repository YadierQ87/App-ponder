<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use app\controllers\SiteController;
$this->title = Yii::$app->name;
?>
<div class="container">
    <div class="col-lg-12">
        <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                foreach ($diapos as $key => $value)
                {?>
                    <li data-target="#myCarousel" data-slide-to="<?=$key?>" class="<?= $key == 0 ? 'active' : null ?>"></li>
                <?php
                }
                ?>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php
                foreach ($diapos as $key => $value)
                {?>
                    <div class="item <?= $key == 0 ? 'active' : null ?>">
                         <div style="color: white; background: url('assets/sitio/imagenes/carousel/<?= $value->ruta_imagen ?>') no-repeat; height: 260px; padding: 20px;">
                            <h3 class="text-<?= $value->titulo_alineacion ?>"><?= $mensajes[$key]['titulo'] ?></h3>
                            <h4 class="text-<?= $value->descripcion_alineacion ?>" style="margin-top: 130px; font-size: <?= $value->descripcion_alineacion ?>px;"><?= $mensajes[$key]['descrip'] ?></h4>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>

<div class="container">
    <?php
    foreach ($cursos as $curso)
    {?>
        <div class="col-lg-4">
            <div class="home-category__cell home-category--programming" style="width: 100%" href="#">
                <div class="category__mobile">
                    <i class="icon"></i>
                </div>
                <div>
                    <div class="card">
                        <div class="card-image">
                            <div class="card-image__content">
                                <p class="card-image__text"><?= substr($curso->descripcion, 0, 75) . '...' ?></p>
                                <a class="card-image__button btn btn-lg btn-orange" href="<?= Url::toRoute(['producto/view', 'id' => $curso->id]) ?>"><?= SiteController::translate('Details') ?> &raquo;</a>
                            </div>
                        </div>
                        <div class="card-content" style="padding-bottom: 20px;">
                            <div>
                                <div><h4 class="card-title"><?= substr($curso->nombre, 0, 32) . '...' ?></h4></div>
                                <div style="float: right"><p style="margin: 0 10px 10px 0; color: #0088e4; font-size: 18px; margin-bottom: 10px;"><?= $curso->precio ?>&euro;</p></div>
                            </div>
                            <div>
                                <p class="card-text badge"><?= $curso->categoria->nombre ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

</div>

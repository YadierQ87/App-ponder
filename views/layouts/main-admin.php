<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\models\AccessHelpers;
use yii\helpers\Url;
use app\assets\AppAssetAdmin;

AppAssetAdmin::register($this);



?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="/assets/sitio/imagenes/varias/icono_app.png" rel="shortcut icon" type="image/x-icon">
    <!--<link type="text/css" href="/App/web/assets/sitio/css/ui.all.css" rel="stylesheet" />
    <link type="text/css" href="/App/web/assets/sitio/css/demos.css" rel="stylesheet" />
    <style type="text/css">
        #myCarousel { padding: 0.8em; }

    </style>-->

    <?php $this->head(); ?>
    
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    /*NavBar::begin([
        'brandLabel' => 'PonderNET Administración',
        'brandUrl' => '/admin',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('app', 'Inicio'), 'url' => ['/admin']],
    ];
    if (Yii::$app->user->isGuest)
    {
        $menuItems[] = ['label' => Yii::t('app', 'Acceder'), 'url' => ['/site/login']];
    }
    else
    {
        $menuItems =
        [
            [
                'label' => 'Ir al sitio',
                'visible' => true,
                'url' => ['/site'],
            ],

            [
                'label' => Yii::t('app', 'Administrar'),
                'visible' => true,
                'items' => [
                    [
                        'label' => 'Entidades',
                        'visible' => 'true',
                        'items' => [
                            ['label' => Yii::t('app', 'Categorías'), 'url' => ['/categoria/admin'], 'visible' => AccessHelpers::getAcceso('categoria/index')],
                            ['label' => Yii::t('app', 'Cursos'), 'url' => ['/producto/admin'], 'visible' => AccessHelpers::getAcceso('producto/index')],
                            ['label' => Yii::t('app', 'Operaciones'), 'url' => ['/operacion'], 'visible' => AccessHelpers::getAcceso('operacion/index')],
                            ['label' => Yii::t('app', 'Pagos'), 'url' => ['/pagos'], 'visible' => AccessHelpers::getAcceso('pagos/index')],
                            ['label' => Yii::t('app', 'Países'), 'url' => ['/pais'], 'visible' => AccessHelpers::getAcceso('pais/index')],
                            ['label' => Yii::t('app', 'Roles'), 'url' => ['/rol'], 'visible' => AccessHelpers::getAcceso('rol/index')],
                            ['label' => Yii::t('app', 'Usuarios'), 'url' => ['/user'], 'visible' => AccessHelpers::getAcceso('user/index')],
                        ]
                    ],
                    [
                        'label' => Yii::t('app', 'Interfaz'),
                        'visible' => true,
                        'items' => [
                            ['label' => Yii::t('app', 'Secciones del sitio'), 'url' => ['/admin/secciones-sitio'], 'visible' => AccessHelpers::getAcceso('categoria/index')],
                            ['label' => Yii::t('app', 'Carrusel de inicio'), 'url' => ['/carrusel'], 'visible' => AccessHelpers::getAcceso('operacion/index')],
                        ],
                    ],
                    [
                        'label' => Yii::t('app', 'Configuración general'), 'url' => ['/app-config'], 'visible' => AccessHelpers::getAcceso('app-config/index')
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'Auditoría'),
                'visible' => AccessHelpers::getAcceso('auditoria/index'),
                'url' => ['/auditoria'],
            ],
            [
                'label' => Yii::t('app', 'Mi cuenta'),
                'items' => [
                    '<li class="dropdown-header" style="color: #2ea2eb;"> ' . Yii::$app->user->identity->username . '</li>',
                    ['label' => Yii::t('app', 'Mi perfil'), 'url' => ['/site/my-profile']],
                    ['label' => Yii::t('app', 'Cambiar contraseña'), 'url' => ['/user/change-password']],
                    '<li class="divider"></li>',
                    ['label' => Yii::t('app', 'Cerrar sesión'), 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                ],
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();*/
    ?>

    <nav id="w1" class="navbar-inverse navbar-fixed-top navbar" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w1-collapse">
                    <span class="sr-only">Alternar navegaci&oacute;n</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Url::toRoute(['/admin']) ?>"><i class="fa fa-gears"></i> PonderNET Administraci&oacute;n</a>
            </div>
            <div id="w1-collapse" class="collapse navbar-collapse">
                <ul id="w2" class="navbar-nav navbar-right nav">
                    <li><a href="<?= Url::toRoute(['/site']) ?>"><i class="fa fa-home"></i> Ir al sitio</a></li>

                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-gear"></i> Administrar <b class="caret"></b></a>
                        <ul id="w3" class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a href="#" tabindex="-1">Entidades <i class="fa fa-caret-right"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= Url::toRoute(['/categoria/admin']) ?>" tabindex="-1">Categorías</a></li>
                                    <li><a href="<?= Url::toRoute(['/producto/admin']) ?>" tabindex="-1">Cursos</a></li>
                                    <li><a href="<?= Url::toRoute(['/operacion']) ?>" tabindex="-1">Operaciones</a></li>
                                    <li><a href="<?= Url::toRoute(['/pagos']) ?>" tabindex="-1">Pagos</a></li>
                                    <li><a href="<?= Url::toRoute(['/pais']) ?>" tabindex="-1">Países</a></li>
                                    <li><a href="<?= Url::toRoute(['/rol']) ?>" tabindex="-1">Roles</a></li>
                                    <li><a href="<?= Url::toRoute(['/user']) ?>" tabindex="-1">Usuarios</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="#" tabindex="-1">Interfaz <i class="fa fa-caret-right"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href=" <?= Url::toRoute(['/admin/secciones-sitio']) ?>  " tabindex="-1">Secciones del sitio</a></li>
                                    <li><a href="<?= Url::toRoute(['/carrusel']) ?>" tabindex="-1">Carrusel de inicio</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= Url::toRoute(['/categoria/admin']) ?>/app-config" tabindex="-1">Configuraci&oacute;n general</a></li>
                        </ul>
                    </li>

                    <li><a href="<?= Url::toRoute(['/auditoria']) ?>"><i class="fa fa-bell"></i> Auditor&iacute;a</a></li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-user"></i> Mi cuenta <b class="caret"></b></a>
                        <ul id="w4" class="dropdown-menu">
                            <li class="dropdown-header" style="color: #2ea2eb;"><?= Yii::$app->user->identity->username ?></li>
                            <li><a href="<?= Url::toRoute(['/site/my-profile']) ?>" tabindex="-1">Mi perfil</a></li>
                            <li><a href="<?= Url::toRoute(['/user/change-password']) ?>" tabindex="-1">Cambiar contraseña</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= Url::toRoute(['/site/logout']) ?>" data-method="post" tabindex="-1">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; PonderNET <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

<script type="text/javascript">
    $(document).ready(function(){
       // $('[data-toggle="tooltip"]').tooltip();

        var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
          var matches, substringRegex;
          matches = [];
          substrRegex = new RegExp(q, 'i');

          $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
              matches.push(str);
            }
          });

          cb(matches);
        };
      };

      var paises = <?= \app\controllers\StaticMembers::CargarNomenclador("pais") ?>;
      var provs = <?= \app\controllers\StaticMembers::CargarNomenclador("prov") ?>;
      var munics = <?= \app\controllers\StaticMembers::CargarNomenclador("munic") ?>;

      $('.typeahead-pais').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'paises',
        source: substringMatcher(paises)
      });

      $('.typeahead-prov').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'provs',
        source: substringMatcher(provs)
      });

      $('.typeahead-munic').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'munics',
        source: substringMatcher(munics)
      });

    });
</script>

</body>
</html>
<?php $this->endPage() ?>

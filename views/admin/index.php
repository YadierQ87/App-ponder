<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = Yii::$app->name;
?>
<div class="site-index">
    
    <div class="jumbotron">
        <h1>M&oacute;dulo de Administraci&oacute;n de PonderNET</h1>
        <p class="lead">Web de Formaci&oacute;n Online</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Usuarios</h2>

                <p>Examine, modifique o elimine usuarios del sistema.</p>

                <p><a class="btn btn-primary" href="<?= Url::toRoute(['/user']) ?>">Continuar &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Cursos</h2>

                <p>Agregue, modifique o elimine cursos del sistema.</p>

                <p><a class="btn btn-primary" href="<?= Url::toRoute(['producto/admin']) ?>">Continuar &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Contactos</h2>

                <p>Agregue, modifique o elimine contactos del sistema.</p>

                <p><a class="btn btn-primary" href="<?= Url::toRoute(['/contactos']) ?>">Continuar &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>P&aacute;ginas de Captura</h2>

                <p>Agregue, modifique o elimine p&aacute;ginas de captura del sistema.</p>

                <p><a class="btn btn-primary" href="<?= Url::toRoute(['/pagina-captura']) ?>">Continuar &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Tickets</h2>

                <p>Agregue, modifique o elimine tickets de clientes del sistema.</p>

                <p><a class="btn btn-primary" href="<?= Url::toRoute(['/ticket/indexadmin']) ?>">Continuar &raquo;</a></p>
            </div>

            <div class="col-lg-4">
                <h2>Campa&ntilde;as de Publicidad</h2>

                <p>Agregue,Programe , modifique o elimine Campa&ntilde;as de Publicidad.</p>
                <p><a class="btn btn-primary" href="<?= Url::toRoute(['/campannas-formulario']) ?>">Continuar &raquo;</a></p>
            </div>

            <div class="col-lg-4">
                <h2>Configuraci&oacute;n general</h2>

                <p>Ajuste las opciones generales del sistema.</p>

                <p><a class="btn btn-primary" href="<?= Url::toRoute(['/app-config']) ?>">Continuar &raquo;</a></p>
            </div>
        </div>

    </div>
</div>

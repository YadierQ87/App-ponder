<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\CommonTasks;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = Yii::t('app', 'Administrar ficheros');
$this->params['breadcrumbs'][] = ['label' => 'Administración', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cursos'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Administrar ficheros'), 'url' => ['/producto/gestionar-ficheros', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $model->nombre];

$dirs = explode("/", trim($ruta, '/'));
$urlAcumul = '';
foreach ($dirs as $dir)
{
    $urlAcumul .= "/$dir";
    $this->params['breadcrumbs'][] = ['label' => $dir, 'url' => ['/producto/gestionar-ficheros', 'id' => $model->id, 'ruta' => $urlAcumul]];
}
?>

<?= \app\controllers\StaticMembers::MostrarMensajes() ?>

<div class="producto-update">
    <h3>Ficheros del curso</h3>
</div>

<div class="container" id="contenedor-todo">
    <div class="content">
    
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th>Nombre</th>
                    <th style="width: 10%">Operaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $contTotal = 1;
                    $rutaSubirNivel = substr($ruta, 0, strrpos($ruta, '/'));
                ?>

                <p class="text-center"><?= Html::img('/assets/sitio/imagenes/varias/loading.gif', ['class' => 'hidden', 'id' => 'img-loading']) ?></p>

                <tr><td></td><td><a href="<?=Url::toRoute(['producto/gestionar-ficheros', 'id' => $model->id, 'ruta' => "$rutaSubirNivel"])?>"><?= Html::img('/assets/sitio/imagenes/file-tree/directory_up.png', ['style' => 'margin-bottom: 3px;', 'alt' => 'Subir un nivel', 'title' => 'Subir un nivel']) ?> ..</a> </td><td> </td></tr>

                <?php
                if (isset($ficheros[0]))
                {
                    foreach ($ficheros[0] as $fichero)
                    {
                    ?>
                        <tr><td><?=$contTotal++?></td><td><a class = "nombre-fichero-file-tree" href="<?=Url::toRoute(['producto/gestionar-ficheros', 'id' => $model->id, 'ruta' => "$ruta/$fichero"])?>"><?= Html::img('/assets/sitio/imagenes/file-tree/directory.png', ['style' => 'margin-top: -4px;']) ?> <?=$fichero?></a> </td><td><a href="<?=Url::toRoute(['producto/eliminar-carpeta', 'curso' => $model->id, 'ruta' => $ruta, 'index' => $contTotal - 2])?>" title="Eliminar" aria-label="Delete" data-confirm="¿Confirma que desea eliminar este elemento?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
                    <?php
                    }
                }
                $contFichero = 0;
                if (isset($ficheros[1]))
                {
                    foreach ($ficheros[1] as $fichero)
                    {
                        $ext = strtolower(substr($fichero, strrpos($fichero, ".") + 1));
                    ?>
                        <tr><td><?=$contTotal++?></td><td><?= Html::img('/assets/sitio/imagenes/file-tree/' . CommonTasks::getExtensionIcono($ext) . '.png', ['style' => 'margin-bottom: 5px;', 'class' => 'nombre-fichero-file-tree']) ?><span class="nombre-fichero-file-tree"> <?=$fichero?></span></td><td><a href="<?=Url::toRoute(['producto/eliminar-fichero', 'curso' => $model->id, 'ruta' => $ruta, 'index' => $contFichero++])?>" title="Eliminar" aria-label="Delete" data-confirm="¿Confirma que desea eliminar este elemento?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
                    <?php
                    }
                }?>
            </tbody>
        </table>
    </div>

    <br/>
    <div class="producto-update">

        <?php $form = ActiveForm::begin([
            "method" => "post",
            "enableClientValidation" => true,
            "action" => Url::toRoute('producto/crear-carpeta'),
            "id" => "formNuevaCarpeta",
            ]);
        ?>
            <input id="curso" name="curso" type="hidden" value="<?=$model->id?>" />
            <input id="ruta" name="ruta" type="hidden" value="<?=$ruta?>" />
            <div class="row">
                <div class="col-lg-3">
                    <input class="form-control" type="text" id="txtNuevaCarpeta" name="txtNuevaCarpeta" placeholder="Nueva carpeta" maxlength="64" />
                </div>
                <div class="col-lg-3">
                    <a class="btn btn-primary" href="javascript:enviarFormNuevaCarpeta()">Crear carpeta</a>
                </div>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

    <br/>
    <hr/>
    <div class="producto-update">
        <h3>Agregar ficheros</h3>
        <div class="producto-form">

            <?php $form = ActiveForm::begin([
                 "method" => "post",
                 "enableClientValidation" => true,
                 "options" => ["enctype" => "multipart/form-data"],
                 "action" => Url::toRoute(['producto/gestionar-ficheros', 'id' => $model->id, 'ruta' => $ruta])
            ]); ?>

            <?= $form->field($modelUpload, 'someFile')->fileInput() ?>

            <div class="form-group">
                <!--<button formmethod="POST" class="btn btn-primary" onclick="index.php/?r=producto/gestionar-ficheros&id=<?=$model->id?>">Subir</button>-->
                <?= Html::submitButton(Yii::t('app', 'Enviar fichero'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>


<script type="text/javascript">
    function enviarFormNuevaCarpeta()
    {
        document.getElementById("formNuevaCarpeta").submit();
    }
</script>

<script type="text/javascript">
    
    function navegarCurso(idCurso, ruta) {
        
        $(document).ready(function ()
        {
            $('#img-loading').removeClass('hidden');
            $.ajax({
                type: 'POST',
                url: "<?= Url::toRoute(['producto/get-ficheros-json']) ?>" + "/?id=" + idCurso + "&ruta=" + ruta,
                dataType: 'json',
                success: function (elem)
                {
                    
                },
                error: function (jqXhr, status) {
                    alert(status + jqXhr);
                },
                complete: function (jqXhr, status) {
                    $('#img-loading').addClass('hidden');
                    $('#contenedor-todo').addClass('hidden');
                }
            });
            return false;
        });
    };
</script>

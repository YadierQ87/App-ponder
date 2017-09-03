<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PaginaCaptura */

$this->title = 'Create Pagina Captura';
$this->params['breadcrumbs'][] = ['label' => 'Pagina Capturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagina-captura-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= \app\controllers\StaticMembers::MostrarMensajes() ?>
    <?= $this->render('_form', [
        'model' => $model,//'ruta'=>$_FILES['fichero_jpg']['tmp_name'],
    ]) ?>

</div>

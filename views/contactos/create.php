<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contactos */

$this->title = 'Create Contactos';
$this->params['breadcrumbs'][] = ['label' => 'Contactos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contactos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

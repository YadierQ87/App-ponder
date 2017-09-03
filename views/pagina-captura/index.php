<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $searchModel app\models\PaginaCapturaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagina Capturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagina-captura-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Pagina Captura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $lang_titulo="";
    $lang_contenido="";
        switch (Yii::$app->session->get('language'))
        {
            case 'en-US':
            {
                $lang_titulo="titulo_en";
                $lang_contenido="contenido_en";
            }
                break;
            case 'fr-FR':
            {
                $lang_titulo="titulo_fr";
                $lang_contenido="contenido_fr";
            }
                break;
            case 'pt-PT':
            {
                $lang_titulo="titulo_pt";
                $lang_contenido="contenido_pt";
            }
                break;
            default:
            {
                $lang_titulo="titulo_es";
                $lang_contenido="contenido_es";
            }
                break;
        };
    ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'Imagen de Fondo',
                'value' => function ($data) {
                    return Html::img($data->ruta_imagen_fondo,['style'=>'height: 30px']) ;
                },
                'format'=>'html'
            ],
            //'ruta_imagen_fondo',
            //'titulo_tam_fuente',
            //'titulo_alineacion',
            [
                'attribute' => $lang_titulo,
                'format' => 'raw',
                'value' => function ($data)    {
                    switch (Yii::$app->session->get('language'))
                    {
                        case 'en-US':
                        {
                            return $data->contenido_en;
                        }
                        case 'fr-FR':
                        {
                            return $data->contenido_fr;
                        }
                        case 'pt-PT':
                        {
                            return $data->contenido_pt;
                        }
                        default:
                        {
                            return $data->contenido_es;
                        }
                    }
               },
            ],
            //'titulo_en',
            // 'titulo_es',
            // 'titulo_fr',
            // 'titulo_pt',
            // 'contenido_tam_fuente',
            // 'contenido_alineacion',
            [
                'attribute' => $lang_contenido,
                'format' => 'raw',
                'value' => function ($data)    {
                    switch (Yii::$app->session->get('language'))
                    {
                        case 'en-US':
                        {
                            return $data->titulo_en;
                        }
                        case 'fr-FR':
                        {
                            return $data->titulo_fr;
                        }
                        case 'pt-PT':
                        {
                            return $data->titulo_pt;
                        }
                        default:
                        {
                            return $data->titulo_es;
                        }
                    }
                },
            ],
            // 'contenido_en',
            // 'contenido_es',
            // 'contenido_fr',
            // 'contenido_pt',
            [
                'attribute' => 'estado',
                'value' => function ($data) {
                    return ($data->estado == 1) ? 'Publicado' : 'No Publicado';
                },
                'format'=>'html'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

   /*foreach ($diapos as $key => $value)
   {

    Modal::begin([

    'header' => '<h2>'.$mensajes[$key]['titulo'].'</h2>',
    'toggleButton' => ['label' => 'Ejemplo Pagina Captura'],
        'size'   =>  "modal-lg",
    ]);
    echo  "<div style=\"color: white; position:static  ;background: url('assets/sitio/imagenes/carousel/".$value->ruta_imagen_fondo."') no-repeat; height: 260px;width:870px\">";
   echo "<div style='background-color:#ffffff; position:relative; bottom: -50%; opacity:0|25'  align=\"center\">";
    echo "<div style='color: #000;  '>".$mensajes[$key]['descrip']."</div>";
    echo "<form name=\"contactos\" action=\"procesar.php\" method=\"post\" >";
    echo "<table >";
       echo "<tr>";
       echo "<td style='padding-top: 14px !important;margin-top: 14px !important;'>";
       echo "<input style='color: #000;width: 350px ' placeholder='Ingrese su nombre ...' required='required' type=\"text\" name=\"nombre\" />";
       echo "</td>";
       echo "</tr>";
       echo "<tr >";
       echo "<td style='padding-top: 14px !important;margin-top: 14px !important;' >";
       echo "<input style='color: #000;width: 350px ' placeholder='Ingrese su email ...' type='email' name=\"email\" />";
       echo "</td>";
       echo "</tr>";
       echo "<tr>";
       echo "<td style='padding-top: 14px !important;margin-top: 14px !important;' align='right'>";
       echo "<input style='color: #000 ; ' type=\"submit\" name=\"contactos\" value=\"Enviar\" />";
       echo "</td>";
       echo "</tr>";
    echo  "</table >";
    echo "</form>";
       echo "</div>";
       echo "</div>";
    Modal::end();
   }*/
    ?>
</div>

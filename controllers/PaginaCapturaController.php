<?php

namespace app\controllers;


use Yii;
use app\models\PaginaCaptura;
use app\models\PaginaCapturaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Contactos;
use yii\filters\VerbFilter;

/**
 * PaginaCapturaController implements the CRUD actions for PaginaCaptura model.
 */
class PaginaCapturaController extends Controller
{
    public $layout = 'main-admin';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PaginaCaptura models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaginaCapturaSearch();
        $pagina_captura = new PaginaCaptura();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        try
        {
            $diapos = $pagina_captura->findBySql('select * from `pagina_captura` order by id desc limit 1')->all();
           // $diapos = \app\models\DiaposCarrusel::find()->all();
            $mensajes = null;
            switch (Yii::$app->session->get('language'))
            {
                case 'en-US':
                {
                    $mensajes = Yii::$app->db->createCommand('select titulo_en titulo, contenido_en descrip from `pagina_captura` order by id')->queryAll();
                }
                    break;
                case 'fr-FR':
                {
                    $mensajes = Yii::$app->db->createCommand('select titulo_fr titulo, contenido_fr descrip from `pagina_captura` order by id')->queryAll();
                }
                    break;
                case 'pt-PT':
                {
                    $mensajes = Yii::$app->db->createCommand('select titulo_pt titulo, contenido_pt descrip from `pagina_captura` order by id')->queryAll();
                }
                    break;
                default:
                {
                    $mensajes = Yii::$app->db->createCommand('select titulo_es titulo, contenido_es descrip from `pagina_captura` order by id')->queryAll();
                }
                    break;
            }
        }
        catch (\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
        }
        finally
        {
            return $this->render('index', [ 'searchModel' => $searchModel, 'dataProvider' => $dataProvider,  'diapos' => $diapos, 'mensajes' => $mensajes]);
        }

       /* return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
    }


    /**
     * Displays a single PaginaCaptura model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCapturaContacto($id)
    {
        $this->layout = 'publicidad';
        $pagina = PaginaCaptura::findOne($id);
        $model = new Contactos();
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success', 'Informacion de contacto guardada correctamente!!');
            return $this->render('gracias-pagina',['nombre_pagina' => $pagina->titulo_es ]);
        }
        else {
           // Yii::$app->session->setFlash('warning', 'Informacion de contacto no se pudo procesar!!');
            return $this->render('captura-contacto', ['model' => $model, 'pagina' => $pagina]);
        }
    }

        /**
     * Creates a new PaginaCaptura model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PaginaCaptura();
        if ($model->load(Yii::$app->request->post()) ) {
            $dir_subida='assets/sitio/imagenes/paginacaptura/';
            $today = date('YmdHms');
            $fichero_subido = $dir_subida . 'captura'.($model->id).$today.'.jpg';
            if(!is_dir($dir_subida)) {
                mkdir($dir_subida, 0777);
            }
            if (move_uploaded_file($_FILES['fichero_jpg']['tmp_name'], $fichero_subido)) {
                Yii::$app->session->setFlash('success', 'Foto guardada correctamente!!');
                $model->ruta_imagen_fondo = $fichero_subido;
                $model->save(false);
            }
            else{
                Yii::$app->session->setFlash('warning', 'La foto no pudo ser guardada');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing PaginaCaptura model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Deletes an existing PaginaCaptura model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the PaginaCaptura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PaginaCaptura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaginaCaptura::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

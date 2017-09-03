<?php

namespace app\controllers;

use app\models\Contactos;
use app\models\PaginaCaptura;
use Yii;
use app\models\CampannasFormulario;
use app\models\CampannasFormularioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CampannasFormularioController implements the CRUD actions for CampannasFormulario model.
 */
class CampannasFormularioController extends Controller
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
     * Lists all CampannasFormulario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CampannasFormularioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CampannasFormulario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /** Ejecuta las campannas de forma manual
     * @return string
     */
    public function actionEjecutar($id)
    {
        $this->EjecutaCampaign($id);
        return $this->actionIndex();
    }

    /** ejecutar el script de la base de datos */
    public function actionEjecutarScript()
    {
        $fecha = date('Y-m-d');
        $listados = \app\models\CampannasFormulario::find()->where("dia_envio='$fecha'")->all();
        foreach($listados as $key){
            $this->EjecutaCampaign($key->id);
        }
    }

    /* funcion que ejecuta una campanna segun su id */
    public function EjecutaCampaign($id){
        $model = $this->findModel($id);
        if(is_object($model->paginaCaptura)){
            $pagina = $model->paginaCaptura;
            $listado = Contactos::find()->where(" id_pagina_captura='{$pagina->id}'")->all();
            $body = $pagina->titulo_es.'</br>'.'<label>'.$pagina->contenido_es.'</br>\n'.$pagina->titulo_en.'</br>'.'<label>'.$pagina->contenido_en.'</br>\n'.$model->contenido_publicidad;
            $title = $pagina->titulo_en;
        }
        else{
            $body = $model->contenido_publicidad."</br>";
            $title = "Avisos de Cursos y Otros (Pondernet)";
            $listado = Contactos::find()->all();
        }
        /* se envia el mail para todos los contactos de esa lista */
        foreach($listado as $key){
            $this->EnvioMail($key->email,$body,$title,$key->nombre,$model->nombre_campanna);
            //echo ('-'.$key->email.$body.$title.$key->nombre.$model->nombre_campanna.'</br>');
        }
    }


    public function EnvioMail($mailadrress,$body,$title,$nombre,$campanna){
        return $res = Yii::$app->mailer->compose(['html' => 'campanna','text' => 'campanna-text'],['nombre'=>$nombre,'body'=>$body,'campanna'=>$campanna])
            ->setFrom([\Yii::$app->params['adminEmail'] => \Yii::$app->name . ' robot'])
            ->setTextBody($body)
            ->setTo($mailadrress)
            ->setSubject($title)
            ->send();
    }

    /**
     * Creates a new CampannasFormulario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CampannasFormulario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CampannasFormulario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing CampannasFormulario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CampannasFormulario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CampannasFormulario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CampannasFormulario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

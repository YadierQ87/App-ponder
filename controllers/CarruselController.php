<?php

namespace app\controllers;

use Yii;
use app\models\DiaposCarrusel;
use app\models\search\DiaposCarruselSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadImage;
use yii\web\UploadedFile;

/**
 * CarruselController implements the CRUD actions for DiaposCarrusel model.
 */
class CarruselController extends Controller
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
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $operacion = Yii::$app->controller->route;
        if (!\app\models\AccessHelpers::getAcceso($operacion)) {
            echo $this->render('/site/error', ['name' => 'Error', 'message' => 'You are not allowed to perform this action.']);
        }
        return true;
    }

    /**
     * Lists all DiaposCarrusel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DiaposCarruselSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DiaposCarrusel model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DiaposCarrusel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DiaposCarrusel();
        if ($model->load(Yii::$app->request->post()))
        {
            $post = Yii::$app->request->post();
            $modelUpload = new UploadImage();
            $modelUpload->imageFile = UploadedFile::getInstance($model, 'ruta_imagen');
            
            if ($modelUpload->imageFile)
            {
                $model->save();
                $model->ruta_imagen = $model->id/* . '.' . $modelUpload->imageFile->extension*/;
                $modelUpload->uploadImage(Yii::$app->basePath . "/web/assets/sitio/imagenes/carousel/$model->ruta_imagen");
                $model->ruta_imagen .= '.' . $modelUpload->imageFile->extension;
                $model->save();
                return $this->redirect(['index']);
            }
            else
            {
                Yii::$app->session->setFlash('danger', 'Debe seleccionar una imagen', true);
                return $this->render('create', ['model' => $model]);
            }
        }
        Yii::$app->session->setFlash('warning', 'Las dimensiones aconsejadas para las imágenes del carrusel son de 1140 x 260 px', true);
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing DiaposCarrusel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $ruta_imagen = $model->ruta_imagen;
        
        if ($model->load(Yii::$app->request->post()))
        {
            $post = Yii::$app->request->post();
            $modelUpload = new UploadImage();
            $modelUpload->imageFile = UploadedFile::getInstance($model, 'ruta_imagen');
            
            if ($modelUpload->imageFile)
            {
                $model->ruta_imagen = $model->id/* . '.' . $modelUpload->imageFile->extension*/;
                $modelUpload->uploadImage(Yii::$app->basePath . "/web/assets/sitio/imagenes/carousel/$model->ruta_imagen");
                $model->ruta_imagen .= '.' . $modelUpload->imageFile->extension;
            }
            else
            {
                $model->ruta_imagen = $ruta_imagen;
            }
            if ($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        Yii::$app->session->setFlash('warning', 'Las dimensiones aconsejadas para las imágenes del carrusel son de 1140 x 260 px', true);
        return $this->render('update', ['model' => $model,]);
    }

    /**
     * Deletes an existing DiaposCarrusel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try
        {
            $model = $this->findModel($id);
            $ruta = Yii::$app->basePath . "/web/assets/sitio/imagenes/carousel/$model->ruta_imagen";
            $model->delete();
            unlink($ruta);
        }
        catch(\Exception $exc)
        {
            
        }
        finally
        {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the DiaposCarrusel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DiaposCarrusel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DiaposCarrusel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

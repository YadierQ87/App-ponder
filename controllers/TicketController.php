<?php

namespace app\controllers;

use Yii;
use app\models\Ticket;
use app\models\TicketSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
{
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
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id_user=Yii::$app->user->identity->id;
        $searchModel = new TicketSearch();
        $dataProvider = $searchModel->searchusuario(Yii::$app->request->queryParams,$id_user);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexadmin()
    {
        $this->layout = 'main-admin';
        $searchModel = new TicketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexadmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Ticket model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewadmin($id)
    {
        $this->layout = 'main-admin';
        return $this->render('viewadmin', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ticket();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);

        }
       /* $model = new Ticket();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
    }

    public function actionCreateadmin()
    {
        $this->layout = 'main-admin';
        $model = new Ticket();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['indexadmin']);
        } else {
            return $this->render('createadmin', [
                'model' => $model,
            ]);

        }
        /* $model = new Ticket();

         if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['view', 'id' => $model->id]);
         } else {
             return $this->render('create', [
                 'model' => $model,
             ]);
         }*/
    }
    /**
     * Updates an existing Ticket model.
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

    public function actionUpdateadmin($id)
    {
        $this->layout = 'main-admin';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewadmin', 'id' => $model->id]);
        } else {
            return $this->render('updateadmin', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing Ticket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteadmin($id)
    {
        $this->layout = 'main-admin';
        $this->findModel($id)->delete();

        return $this->redirect(['indexadmin']);
    }

    public function actionCerrar($id)
    {
        // $model = $this->findModel($id);
        try{
            $result = Yii::$app->db->createCommand("UPDATE `ticket` SET `estado` = '2' WHERE `id` = $id")->execute();
            $result == 1 ? null : Yii::$app->session->setFlash('danger', 'No se pudo actualizar la informaci&oacute;n');
            return $this->redirect(['index']);

        }
        catch (\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
            //return $this->render('view-captura', ['model' => $model,]);
            return $this->redirect(['index']);
        }

    }

    public function actionCerraradmin($id)
    {
        // $model = $this->findModel($id);
        try{
            $result = Yii::$app->db->createCommand("UPDATE `ticket` SET `estado` = '2' WHERE `id` = $id")->execute();
            $result == 1 ? null : Yii::$app->session->setFlash('danger', 'No se pudo actualizar la informaci&oacute;n');
            return $this->redirect(['indexadmin']);

        }
        catch (\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
            //return $this->render('view-captura', ['model' => $model,]);
            return $this->redirect(['indexadmin']);
        }

    }
    /**
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

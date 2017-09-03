<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\UploadFile;
use app\models\UploadImage;
use app\models\Producto;
use app\models\search\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use yii\helpers\ArrayHelper;
use app\models\AccessHelpers;
use app\models\auditoria\ContAudit;
use app\models\auditoria\ProductoAudit;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
{
    public $layout = 'main';
    private $rutaCursos = '/web/cursos/';

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $operacion = Yii::$app->controller->route;
        if (in_array($operacion, ['producto/index', 'producto/view', 'producto/comprar', 'producto/simular-compra', 'producto/confirmar-compra', 'producto/ipn-ponder', 'producto/gracias'])) {
            return true;
        }

        if (!AccessHelpers::getAcceso($operacion)) {
            //throw new BadRequestHttpException(SiteController::translate('You are not allowed to perform this action.'));
            echo $this->render('/site/error', ['name' => 'Error', 'message' => 'You are not allowed to perform this action.']);
        }

        return true;
    }

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
                        'actions' => ['simular-compra', 'comprar', 'confirmar-compra', 'ipn-ponder', 'gracias','actualiza-cajas'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'view', 'ipn-ponder', 'comprar', 'confirmar-compra', 'gracias','actualiza-cajas'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['admin', 'create', 'update', 'delete', 'descargar', 'comprar', 'confirmar-compra', 'gestionar-ficheros', 'crear-carpeta', 'eliminar-carpeta', 'eliminar-fichero', 'get-ficheros-json', 'ipn-ponder', 'gracias'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param string $id
     * @return mixed
     */

    /*public static function getRutaCursosCompletaEstatica()
    {
        return Yii::$app->basePath . self::$rutaCursos;
    }*/

    private function getRutaCursosCompleta()
    {
        return Yii::$app->basePath . $this->rutaCursos;
    }

    private function getFicherosCurso($id, $ruta)
    {
        $dir = $this->getRutaCursosCompleta() . "$id$ruta";
        $ficheros = array();
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                $files = $dirs = array();
                while (($file = readdir($dh)) !== false)
                    if ($file != '.' && $file != '..')
                        if (is_dir("$dir/$file")) $dirs[] = $file; else $files[] = $file;
                $ficheros = array($dirs, $files);
                closedir($dh);
            }
        }
        return $ficheros;
    }

    private function getRutaImagenCurso($id)
    {
        $ruta = $this->getRutaCursosCompleta() . 'imagenes/';
        $arrExt = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
        foreach ($arrExt as $ext) {
            $fichero = $id . '.' . $ext;
            if (file_exists($ruta . $fichero)) {
                return $fichero;
            }
        }
        return null;
    }

    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id), 'puedeComprar' => !AccessHelpers::cursoPagado($id), 'imagenCurso' => $this->getRutaImagenCurso($id)]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'main-admin';
        $model = new Producto();
        $modelUpload = new UploadImage();
        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            if ($model->save()) {
                $this->crearCarpetaCurso($model->id);
                $objAudit = new ContAudit(Yii::$app->controller->route, $model->nombre, new ProductoAudit($model));
                AuditoriaController::generarTraza($objAudit);
                $modelUpload->imageFile = UploadedFile::getInstance($model, 'ruta_imagen');
                if ($modelUpload->imageFile) {
                    $modelUpload->uploadImage($this->getRutaCursosCompleta() . "imagenes/$model->id");
                    $model->ruta_imagen = $model->id . '.' . $modelUpload->imageFile->extension;
                    $model->save();
                }
                return $this->redirect(['gestionar-ficheros', 'id' => $model->id]);
            }
            return $this->render('create', ['model' => $model]);
        } else {
            return $this->render('create', ['model' => $model, 'modelUpload' => $modelUpload]);
        }
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelUpload = new UploadImage();
        $this->layout = 'main-admin';
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $modelUpload->imageFile = UploadedFile::getInstance($model, 'ruta_imagen');
                if ($modelUpload->imageFile) {
                    $modelUpload->uploadImage($this->getRutaCursosCompleta() . "imagenes/$model->id");
                    $model->ruta_imagen = $model->id . '.' . $modelUpload->imageFile->extension;
                    $model->save();
                }
                $objAudit = new ContAudit(Yii::$app->controller->route, $model->nombre, new ProductoAudit($model));
                AuditoriaController::generarTraza($objAudit);
                return $this->redirect(['admin']);
            }
            return $this->render('update', ['model' => $model]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->layout = 'main-admin';
        $model = $this->findModel($id);
        $this->eliminarCarpetaCurso($model);
        $model->delete();
        $objAudit = new ContAudit(Yii::$app->controller->route, $model->nombre, new ProductoAudit($model));
        AuditoriaController::generarTraza($objAudit);
        return $this->redirect(['admin']);
    }

    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(SiteController::translate('This element does not exist'));
        }
    }

    private function caracteresValidos($cadena)
    {
        $ascii = '';
        $cantCars = strlen($cadena);
        for ($i = 0; $i < $cantCars; $i++) {
            $car = $cadena[$i];
            $ascii = ord($cadena[$i]);
            if (!in_array($ascii, [32, 40, 41, 43, 44, 45, 46, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 93, 95, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122]))
                return false;
        }
        return true;
    }

    public function actionGestionarFicheros($id, $ruta = '')
    {
        try {
            $model = $this->findModel($id);
            $modelUpload = new UploadFile();
            $post = Yii::$app->request->post();
            $this->layout = 'main-admin';

            if ($modelUpload->load(Yii::$app->request->post())) {
                $modelUpload->someFile = UploadedFile::getInstance($modelUpload, 'someFile');
                if ($modelUpload->someFile) {
                    if ($this->caracteresValidos($modelUpload->someFile->name)) {
                        $modelUpload->someFile->name = str_replace(' ', '_', $modelUpload->someFile->name);
                        $rutaFichero = $this->getRutaCursosCompleta() . "$id$ruta/" . $modelUpload->someFile->name;
                        if (!file_exists($rutaFichero)) {
                            $modelUpload->uploadFile($this->getRutaCursosCompleta() . "./$id$ruta/");
                            $objAudit = new ContAudit(Yii::$app->controller->route, $model->nombre, new ProductoAudit($model, $modelUpload->someFile->name));
                            AuditoriaController::generarTraza($objAudit);
                            Yii::$app->session->setFlash('success', 'El fichero fue enviado correctamente');
                            Yii::$app->session->removeFlash('danger');
                        } else
                            Yii::$app->session->setFlash('danger', 'Ya existe un fichero con ese nombre en la carpeta. Si desea actualizarlo, elimine primero el anterior.', true);
                    } else
                        Yii::$app->session->setFlash('danger', 'El nombre del fichero contiene caracteres no permitidos', true);
                } else
                    Yii::$app->session->setFlash('warning', 'Debe seleccionar un fichero válido', true);
            }

            if (file_exists($this->getRutaCursosCompleta() . "$id$ruta")) {
                return $this->render('gestionar-ficheros', ['ruta' => $ruta, 'model' => $model, 'modelUpload' => $modelUpload, 'ficheros' => $this->getFicherosCurso($id, $ruta)]);
            }
            return $this->render('/site/error', ['name' => 'Not Found (#404)', 'message' => 'No existe la carpeta del curso']);
        } catch (\Exception $exc) {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
        }
    }

    public function actionGetFicherosJson($id, $ruta = '')
    {
        $ficheros = $this->getFicherosCurso($id, $ruta);
        return json_encode($ficheros);
    }

    private function downloadFile($dir, $file, $extensions = [])
    {
        if (is_dir($dir)) {
            $path = $dir . $file;
            if (is_file($path)) {
                $file_info = pathinfo($path);
                $extension = $file_info["extension"];
                if (is_array($extensions)) {
                    foreach ($extensions as $e) {
                        if ($e === $extension || $e == '*') {
                            $size = filesize($path);
                            header("Content-Type: application/force-download");
                            header("Content-Disposition: attachment; filename=$file");
                            header("Content-Transfer-Encoding: binary");
                            header("Content-Length: " . $size);
                            readfile($path);
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public function actionDescargar()
    {
        $curso = Yii::$app->request->get("curso");
        $ruta = trim(Yii::$app->request->get("ruta"));
        $fichero = Yii::$app->request->get("fichero");

        if (AccessHelpers::cursoPagado($curso)) {
            if ($fichero && $curso) {
                $ruta = $this->getRutaCursosCompleta() . "/$curso/$ruta/";
                if (!$this->downloadFile($ruta, Html::encode($_GET["fichero"]), ["*"]))
                    Yii::$app->session->setFlash('danger', 'No se puede descargar este fichero.');
                else
                    Yii::$app->session->removeFlash('danger');
            } else {
                Yii::$app->session->setFlash('danger', 'Debe seleccionar un nombre de archivo válido.');
            }
        } else {
            Yii::$app->session->setFlash('danger', 'Usted no ha abonado aun la cuota correspondiente a este curso.');
        }
        return $this->actionView($curso);
    }

    public function actionCrearCarpeta()
    {
        $post = Yii::$app->request->post();
        $model = $this->findModel($post['curso']);
        $modelUpload = new UploadFile();
        $rutaActual = $post['ruta'];
        $this->layout = 'main-admin';
        if ($post['txtNuevaCarpeta'] != '') {
            $nuevaCarpeta = $post['txtNuevaCarpeta'];
            $ruta = $this->getRutaCursosCompleta() . "$model->id$rutaActual";
            if (file_exists($ruta)) {
                $ruta .= "/$nuevaCarpeta";
                /*echo $ruta;
                die;*/
                if (!file_exists($ruta)) {
                    if (!mkdir($ruta))
                        Yii::$app->session->setFlash('danger', 'Ha ocurrido un error al crear la carpeta');
                    else {
                        $objAudit = new ContAudit(Yii::$app->controller->route, $model->nombre, new ProductoAudit($model, $nuevaCarpeta));
                        AuditoriaController::generarTraza($objAudit);
                        Yii::$app->session->setFlash('success', 'La carpeta ha sido creada correctamente');
                    }
                } else
                    Yii::$app->session->setFlash('danger', 'Ya existe una carpeta con ese nombre en la ruta especificada.');
            } else
                Yii::$app->session->setFlash('danger', 'No existe la carpeta de nivel superior');
        } else
            Yii::$app->session->setFlash('warning', 'Debe especificar un nombre para la nueva carpeta');
        return $this->render('gestionar-ficheros', ['model' => $model, 'modelUpload' => $modelUpload, 'ruta' => $post['ruta'], 'ficheros' => $this->getFicherosCurso($model->id, $rutaActual)]);
    }

    public function actionEliminarCarpeta($curso, $ruta, $index)
    {
        $this->layout = 'main-admin';
        return $this->eliminarRecurso($curso, $ruta, $index, 0);
    }

    public function actionEliminarFichero($curso, $ruta, $index)
    {
        $this->layout = 'main-admin';
        return $this->eliminarRecurso($curso, $ruta, $index, 1);
    }

    private function eliminarCarpetaRecursiva($dir)
    {
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file))
                $this->eliminarCarpetaRecursiva($file);
            else
                unlink($file);
        }
        rmdir($dir);
    }

    private function eliminarRecurso($curso, $ruta, $index, $tipo)
    {
        try {
            $model = $this->findModel($curso);
            $modelUpload = new UploadFile();
            $ficheros = $this->getFicherosCurso($curso, $ruta);
            $recurso = $ficheros[$tipo][$index];
            $rutaFichero = $this->getRutaCursosCompleta() . "$curso/$ruta/$recurso";
            if ($tipo == 0) {
                $this->eliminarCarpetaRecursiva($rutaFichero);
            } else {
                unlink($rutaFichero);
            }
            $objAudit = new ContAudit(Yii::$app->controller->route, $model->nombre, new ProductoAudit($model, $recurso));
            AuditoriaController::generarTraza($objAudit);
            ArrayHelper::remove($ficheros, $index);
            Yii::$app->session->setFlash('success', 'El recurso ha sido eliminado correctamente');
            return $this->render('gestionar-ficheros', ['model' => $model, 'modelUpload' => $modelUpload, 'ruta' => $ruta, 'ficheros' => $this->getFicherosCurso($curso, $ruta)]);
        } catch (Exception $exc) {
            Yii::$app->session->setFlash('danger', 'Ha ocurrido un error al eliminar el recurso.\n' . $exc->getMessage());
            return $this->render('gestionar-ficheros', ['model' => $model, 'modelUpload' => $modelUpload, 'ruta' => $ruta, 'ficheros' => $this->getFicherosCurso($curso, $ruta)]);
        }
    }

    private function eliminarCarpetaCurso($model)
    {
        try {
            //Eliminar la imagen del curso
            $rutaImagen = $this->getRutaImagenCurso($model->id);
            if (isset($rutaImagen)) {

                $rutaFichero = $this->getRutaCursosCompleta() . "imagenes/$rutaImagen";
                unlink($rutaFichero);
            }
            //Eliminar la carpeta de ficheros del curso
            $rutaFichero = $this->getRutaCursosCompleta() . "$model->id";
            if (file_exists($rutaFichero)) {
                FileHelper::removeDirectory($rutaFichero);
                Yii::$app->session->setFlash('success', 'El curso ha sido eliminado correctamente');
                return $this->actionIndex();
            }
        } catch (Exception $exc) {
            Yii::$app->session->setFlash('danger', 'Ha ocurrido un error al eliminar el recurso.\n' . $exc->getMessage());
            return $this->render('gestionar-ficheros', ['model' => $model, 'modelUpload' => $modelUpload, 'ruta' => $ruta, 'ficheros' => $this->getFicherosCurso($curso, $ruta)]);
        }
    }

    private function crearCarpetaCurso($id)
    {
        try {
            $rutaFichero = Yii::$app->basePath . "/web/cursos/$id";
            if (!file_exists($rutaFichero)) {
                mkdir($rutaFichero);
                Yii::$app->session->setFlash('success', 'El curso ha sido creado correctamente');
            } else
                Yii::$app->session->setFlash('warning', 'Ya existía una carpeta creada para este curso');
        } catch (Exception $exc) {
            Yii::$app->session->setFlash('danger', 'Ha ocurrido un error al crear el curso: ' . $exc->getMessage());
            return $this->render('gestionar-ficheros', ['model' => $model, 'modelUpload' => $modelUpload, 'ruta' => $ruta, 'ficheros' => $this->getFicherosCurso($curso, $ruta)]);
        }
    }

    public function actionComprar($id)
    {
        if (!AccessHelpers::cursoPagado($id)) {
            $post = Yii::$app->request->post();
            return $this->render('comprar', ['model' => $this->findModel($id), 'puedeComprar' => true, 'cuenta_paypal' => \app\models\AppConfig::findOne('1')->cuenta_paypal]);
        }
        Yii::$app->session->setFlash('danger', SiteController::translate('You have already bought this course.'));
        return $this->render('view', ['model' => $this->findModel($id), 'puedeComprar' => false]);
    }


    public function LlenarNiveles()
    {
        //para entrar a los niveles el usuario tiene que tener 1 compra y dos usuarios referidos con al menos una compra cada uno
        //Paso 1 Verificar compra de Usuario
        $paso = 0;
        $miId = Yii::$app->user->id;
        $user = UserController::findModel($miId);
        $compra = CursoAbonado::find()->where(['id_usuario' => $miId]);
        $ventas = CursoAbonado::find()->where(['referido_por' => $miId]);
        if (count($compra) >= 1)
            $paso++;
        //Verificar cantd de referidos
        $referidos = $user->getReferidos();
        $max = count($referidos);
        $cantd = 0;
        //verificar cantd de compras de los referidos
        for ($i = 0; $i < $max; $i++) {
            if ($user->getCompras($referidos[$i]->id_user) >= 1)
                $cantd++;
        }
        //si hay 2 o + referidoss con al menos una compra cada uno el usuario entra en caja.
        if ($max >= 2 && $cantd >= 2)
            $paso++;
        //Son 24 niveles el nivel 25 ya es la caja 5
        //insertar en la tabla niveles
        //Existen 6 usuarios x caja donde 3 empujan a 3
        //No hay usuarios repetidos
    }

    public function actionIpnPonder()
    {
        $status = $nombre = $payment = $id = $titulo = "";
        if (isset($_GET['tx']) && ($_GET['tx']) != null && ($_GET['tx']) != "") {
            $tx = $_GET['tx'];
            //$response = $this->verifyWithPayPal($tx);
            //$nombre = $_GET["item_name"];
            $payment = $_GET["amt"];
            $id = $_GET["item_number"];
            $status = $_GET["st"];
            $titulo = "No se ha registrado la compra";

           /* $item_name = $_POST['item_name'];
            $item_number = $_POST['item_number'];
            $payment_status = $_POST['payment_status'];
            $payment_amount = $_POST['mc_gross'];
            $payment_currency = $_POST['mc_currency'];
            $txn_id = $_POST['txn_id'];
            $receiver_email = $_POST['receiver_email'];
            $payer_email = $_POST['payer_email'];*/

            if ($status = "Completed") {
                try {
                    $titulo = "Gracias x Comprar en Pondernet";
                    $id_usuario = Yii::$app->user->id;
                    $producto = Producto::findOne(['id' => $id]);
                    $nombre = $producto["nombre"];
                    $usuario = User::findOne(['id' => "$id_usuario"]);
                    $referido_por = $usuario['referido_por'];
                    $correo = $usuario['email'];
                    $comision = round($producto['rebaja']);
                    //proceso que pone a los usuarios en las cajas
                    $this-> UsuariosCajas($id_usuario);
                    $sql = "INSERT INTO curso_abonado (id, id_usuario, id_producto, comision, referido_por)  VALUES (NULL, '$id_usuario', '$id', '$comision', '$referido_por')";
                    $comando = Yii::$app->db->createCommand($sql);
                    $comando->execute();
                } catch (\Exception $exc) {
                    //Yii::$app->session->setFlash('danger', $exc->getMessage());
                }
                $usuariosNotif = \app\models\User::findBySql('select * from user where id in (select id_usuario from nivel_caja5 where notificado = 0)')->all();
                try {
                    foreach ($usuariosNotif as $usuario) {
                        $res = Yii::$app->mailer->compose(['html' => 'notifRetiroFondo-html', 'text' => 'notifRetiroFondo-text'], ['model' => $usuario->attributes])
                            ->setFrom([\Yii::$app->user->identity->email => \Yii::$app->name . ' robot'])
                            ->setTo($usuario->attributes['email'])
                            ->setSubject(SiteController::translate('Retiring funds on ') . Yii::$app->name)
                            ->send();
                        $modelNotif = \app\models\Caja5::find(['id_usuario' => $usuario->attributes['id']])->one();
                        $modelNotif->setAttribute('notificado', 1);
                        $modelNotif->save(false);
                    }
                } catch (\Exception $exc) {
                    Yii::$app->session->setFlash('danger', $exc->getMessage());
                }
                //echo $sql;
                return $this->actionGracias($status, $nombre, $payment, $id, $titulo);
            }
        }
        return $this->actionGracias($status, $nombre, $payment, $id, $titulo);
    }

    public function actionActualizaCajas(){
       /* $usuariosNotif = Yii::$app->db->createCommand("select * from user order By created_at")->queryAll();
        //var_dump($usuariosNotif);
        $tot = 0;
        $max = count($usuariosNotif);
        if ( $max >= 0) {
            for ($i=0 ; $i < $max ; $i++){
                $id_usuario = $usuariosNotif[$i]["id"];
                try{
                   $tot += $this->UsuariosCajas($id_usuario);
                }
            catch (\Exception $exc) {
                    Yii::$app->session->setFlash('danger', $exc->getMessage());
                }
            }
        }
        echo "se registraron $tot usuarios"."</br>";*/
        $result = $this->my_actualizar();
        echo count($result)." registros nuevos";
    }

    public function my_actualizar()
    {
        $date = date("Y-m-d");
        $comando = Yii::$app->db->createCommand("call my_carga()");
        $comando->execute();
        $sql = "SELECT * FROM `nivel_cajas` WHERE fecha = '$date' ORDER BY `id` DESC LIMIT 24 OFFSET 1";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    public function UsuariosCajas($id_usuario)
    {
        $user = User::findOne($id_usuario);
        $Ureferido = User::findOne($user->referido_por);
        $id = $Ureferido->id;
        $fecha = date("Y-m-d");
        $sum = 0;
        $usuariosNotif = Yii::$app->db->createCommand("select * from user where referido_por = '$id'")->queryAll();
        $max = count($usuariosNotif);
        if ( $max >= 2) {
            for ($i=0 ; $i < $max ; $i++){
                $myid = $usuariosNotif[$i]["id"];
                $conm = $Ureferido->getCompras($myid);
                if($conm[0]["cantd_usuarios"] > 0)
                   $sum++;
            }
        }
        if ($sum >= 2) {
            //se va a guardar ese usuario en los niveles de caja pk cumple todos los parametros
            $sql = "SELECT * from nivel_cajas LIMIT 24 OFFSET 0";
            $niveles  = Yii::$app->db->createCommand($sql)->queryAll();
            //si los niveles estan llenos entonces pasa a la caja 5
            if(count($niveles)>=24){
                //before insert
                $insert = "INSERT INTO nivel_caja5 (id_usuario,fecha,notificado) VALUES (SELECT id_usuario from nivel_cajas LIMIT 1 OFFSET 1, '$fecha', '0');";
                $comando = Yii::$app->db->createCommand($insert);
                $comando->execute();
                //delete
                $delete = "DELETE FROM nivel_cajas WHERE id_usuario in (SELECT id_usuario from nivel_cajas LIMIT 1 OFFSET 1)";
                $comando2 = Yii::$app->db->createCommand($delete);
                $comando2->execute();
            }
            //sino se inserta en los niveles de las cajas
            else{
                //entra en el circuito de cajas
                $insert = "INSERT INTO nivel_cajas(id,id_usuario,fecha) VALUES (NULL,'$id','$fecha');";
                $comando = Yii::$app->db->createCommand($insert);
                $comando->execute();
            }
        }
        return $sum;
    }



    public function actionConfirmarCompra($id)    {
        try
        {
            $post = Yii::$app->request->post();
            if ($post)
            {
                $paypal_account = $post['business'];
                $paypal_currency = 'EUR';
                $solic = 'cmd=_notify-validate';
                foreach ($post as $key => $value)
                {
                    $value = urlencode(stripslashes($value));
                    $solic .= "&$key=$value";
                }
                $url = "https://www.paypal.com/cgi-bin/webscr";
                $item_name = $post['item_name']; //El nombre de nuestro artículo o producto.
                $order_id = $post['item_number']; //El numero o ID de nuestro producto o invoice.
                $payment_status = $post['payment_status']; //El estado del pago
                $amount = $post['mc_gross']; //El monto total pagado
                $payment_currency = $post['mc_currency']; //La moneda con que se ha hecho el pago
                $transaction_id = $post['txn_id']; //EL ID o Código de transacción.
                //$receiver_email = 'paypal@pondernet.com';
                $receiver_email = 'programador-buyer@pondernet.com';
                $customer_email = $post['payer_email']; //La cuenta que ha enviado el pago.
                if($paypal_account != $receiver_email)
                {
                   exit;
                }
                $res = file_get_contents($url . "?" . $solic);
                if (strcmp (trim($res), "VERIFIED") == 0)
                {
                    if($payment_currency != $paypal_currency)
                    {
                        exit;
                    }
                    if ($payment_status != "")
                    {
                        $model = $this->findModel($id);
                        $modelAbonado = new CursoAbonado(['id_usuario' => Yii::$app->user->id, 'id_producto' => $id, 'comision' => round((($model->rebaja) ? $model->rebaja : $model->precio) / 2)]);
                        $modelAbonado->save(false);
                        /* insertando en la BD */
                        $id_usuario = Yii::$app->user->id;
                        $producto  = Producto::findOne(['id' => $id]);
                        $usuario = User::findOne(['id' => $id_usuario]);
                        $referido_por = $usuario['referido_por'];
                        $comision = round($producto['rebaja']);
                        $comando = Yii::$app->db->createCommand("INSERT INTO curso_abonado (id, id_usuario, id_producto, comision, referido_por)  VALUES (NULL, '$id_usuario', '$id', '$comision', '$referido_por')");
                        $comando->execute();
                        /*fin del insertar */
                        $usuariosNotif = \app\models\User::findBySql('select * from user where id in (select id_usuario from caja_5 where notificado = 0)')->all();

                        try
                        {
                            foreach ($usuariosNotif as $usuario)
                            {
                                $res = Yii::$app->mailer->compose(['html' => 'notifRetiroFondo-html', 'text' => 'notifRetiroFondo-text'], ['model' => $usuario->attributes])
                                    ->setFrom([\Yii::$app->user->identity->email => \Yii::$app->name . ' robot'])
                                    ->setTo($usuario->attributes['email'])
                                    ->setSubject(SiteController::translate('Retiring funds on ') . Yii::$app->name)
                                    ->send();
                                $modelNotif = \app\models\Caja5::find(['id_usuario' => $usuario->attributes['id']])->one();
                                $modelNotif->setAttribute('notificado', 1);
                                $modelNotif->save(false);
                            }
                        }
                        catch (\Exception $exc)
                        {
                            Yii::$app->session->setFlash('danger', $exc->getMessage());
                        }
                        return true;
                    }
                    else
                    {
                        Yii::$app->session->setFlash('danger', SiteController::translate('Payment process has not been completed. Try again later.'));
                    }
                }
            }
            return $this->render('comprar', ['model' => $this->findModel($id)]);
        }
        catch (\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
            return $this->render('comprar', ['model' => $this->findModel($id)]);
        }
    }
    

    public function actionGracias($st,$amt,$tx,$item_name)
    {
        $link = Html::a(SiteController::translate('Office'), ['site/oficina']);
        $message = "<div class=\"producto-view\">
    <h3>$item_name</h3>
    Before the transaction
    Product ($item_name)<br>
    Payment ($amt)<br>
    has processed to ($st)<br>
    You must go to  $link
</div>";
        Yii::$app->session->setFlash('success', $message);
        //return $this->redirect('index.php?r=producto/view&id='.$id, ['model' => $this->findModel($id), 'puedeComprar' => !AccessHelpers::cursoPagado($id), 'imagenCurso' => $this->getRutaImagenCurso($id)]);
        return $this->redirect(['site/oficina']);
       // return $this->actionView($id);
    }

    public function actionAdmin()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $this->layout = 'main-admin';
        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }



    public function exitCode() {
        die("Error");
        //exit with error message
    }

    public function verifyWithPayPal($tx) {
        $req = 'cmd=_notify-synch';
        $tx_token = $tx;
        $auth_token = "GvThBNCLDEb-xiOwKhU8RAB79FliDa6TArzhI6A0QWjorlAD5IL9igOf_eG";
        $req .= "&tx=$tx_token&at=$auth_token";
        // post back to PayPal system to validate
        $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Host: http://www.sandbox.paypal.com\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
        // url for paypal sandbox
        //$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
        // url for payal
       $fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);
        // If possible, securely post back to paypal using HTTPS
        // Your PHP server will need to be SSL enabled
        //$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
        if (!$fp) {
            exitCode();
        } else {
            fputs ($fp, $header . $req);
            // read the body data
            $res = '';
            $headerdone = false;
            while (!feof($fp)) {
                $line = fgets ($fp, 1024);
                if (strcmp($line, "\r\n") == 0) {
                    // read the header
                    $headerdone = true;
                }
                else if ($headerdone) {
                    // header has been read. now read the contents
                    $res .= $line;
                }
            }
            // parse the data
            $lines = explode("\n", $res);
            $response = array();
            if (strcmp ($lines[0], "SUCCESS") == 0) {
                for ($i=1; $i<count($lines);$i++){
                    list($key,$val) = explode("=", $lines[$i]);
                    $response[urldecode($key)] = urldecode($val);
                }
                // $itemName = $response["item_name"];
                $amount = $response["payment_gross"];
                $myEmail = $response["receiver_email"];// debe ser podenrnet.com
                $userEmail = $response["payer_email"]; //La cuenta que ha enviado el pago.
                $paymentStatus = $response["payment_status"];
                $paypalTxId = $response["txn_id"];
                $currency = $response["mc_currency"];
                $order_id = $response['item_number']; //El numero o ID de nuestro producto o invoice.
                // check the payment_status is Completed
                if($paymentStatus != "" && $myEmail == 'paypal@pondernet.com')
                {
                    $producto  = Producto::findOne(['id' => $order_id]);
                    $id_prod   = $producto["id"];
                    $usuario = User::findOne(['email' => $userEmail]);
                    $id_usuario = $usuario["id"];
                    $referido_por = $usuario['referido_por'];
                    $comision = round((($producto['rebaja']) ? $producto['rebaja'] : $producto['precio']) / 2);
                    $comando = Yii::$app->db->createCommand("INSERT INTO curso_abonado (id, id_usuario, id_producto, comision, referido_por)  VALUES (NULL, '$id_usuario', '$id_prod', '$comision', '$referido_por')");
                    $comando->execute();
                }
                return $response;
                // check that txn_id has not been previously processed
                //checkIfTransactionHasAlreadyBeenProcessed($paypalTxId);
                // check that receiver_email is your Primary PayPal email
                //checkThatPaymentIsReceivedAtYourEmailAddress($myEmail);
                // check that payment_amount/payment_currency are correct
                //checkPaymentAmountAndCurrency($amount, $currency);

            } else {
                exitCode();
            }
        }
        fclose ($fp);
    }

}

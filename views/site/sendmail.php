<?php
use app\controllers\SiteController;
use yii\helpers\Html;

if ($curso_id)
{
    $signupLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/signup', 'referente' => Yii::$app->user->identity->username, 'id_curso' => $curso->id]);
    $verCurso = \Yii::$app->urlManager->createAbsoluteUrl(['producto/view', 'id' => $curso_id]);
}
else
{
    $signupLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/signup', 'referente' => Yii::$app->user->identity->username]);
    $verCurso = null;
}
$verSitio = \Yii::$app->urlManager->createAbsoluteUrl(['site']);

$present = SiteController::translate('Dear user:')."\n" ;
$username = Yii::$app->user->identity->nombre . ' ' . Yii::$app->user->identity->apellidos . ' (' . Yii::$app->user->identity->email . ') '.SiteController::translate('has sent you an invitation to ');
if (isset($curso_id))
    $comprar = SiteController::translate('buy the course ') . "<a href=\"$verCurso\">" . $curso_nombre . '</a>';
else
    $comprar = SiteController::translate('join him');
$linksitio = SiteController::translate(' on ') . "<a href=\"$verSitio\">" . Yii::$app->name . '</a>';
$final = SiteController::translate('Please, follow the link below to accept it:') ;
$toAcept = Html::a(Html::encode($signupLink), $signupLink) ;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

require("libs/PHPMailer/class.phpmailer.php");
require("libs/PHPMailer/class.smtp.php");
$mail = new PHPMailer();
//Luego tenemos que iniciar la validación por SMTP:
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.1and1.es"; // A RELLENAR. Aquí pondremos el SMTP a utilizar. Por ej. mail.midominio.com
$mail->Username = "info@pondernet.com"; // A RELLENAR. Email de la cuenta de correo. ej.info@midominio.com La cuenta de correo debe ser creada previamente.
$mail->Password = "pondernetcorreo"; // A RELLENAR. Aqui pondremos la contraseña de la cuenta de correo
$mail->Port = 25; // Puerto de conexión al servidor de envio.
$mail->From = 'info@pondernet.com'; // A RELLENARDesde donde enviamos (Para mostrar). Puede ser el mismo que el email creado previamente.
$mail->FromName = 'Pondernet Correo Robot'; //A RELLENAR Nombre a mostrar del remitente.
$mail->AddAddress($destinatario); // Esta es la dirección a donde enviamos
$mail->IsHTML(true); // El correo se envía como HTML
$mail->Subject = html_entity_decode( SiteController::translate('Invitation for ') . Yii::$app->name); // Este es el titulo del email.
$body = $present."\n";
$html = $username."\n";
$html .= $comprar."\n";
$html .= $linksitio."\n";
$html .= $final."\n";
$html .= $toAcept."\n";

$mail->Body = $body.$html; // Mensaje a enviar.
$exito = $mail->Send(); // Envía el correo.

if ($exito == '1')
{
    Yii::$app->session->setFlash('success', SiteController::translate('The message has been sent.'));
}
else
{
    $error = $mail->ErrorInfo;
    Yii::$app->session->setFlash('warning', SiteController::translate('The message has not been sent.')." ".$error);
}

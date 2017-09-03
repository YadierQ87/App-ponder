<?php
include_once("../web/libs/PHPMailer/class.phpmailer.php");
include_once("../web/libs/PHPMailer/class.smtp.php");
  $fecha = date('Y-m-d');
  $sql = "SELECT id,dia_envio,tipo_tarea,id_tb_pagina_captura,contenido_publicidad FROM campannas_formulario";

   $lista_campanas =  get_listado($sql);
   for($i=0; $i < count($lista_campanas); $i++){
       EjecutaCampaign($lista_campanas[$i]->id);
   }

/* funcion para deolver lista de objetos mysql */
function get_listado($sql){

    $mysqli = new mysqli('localhost','root','','db613064228','3306');
    $result = $mysqli->query($sql);
    $listado = array();
    while ($row = $result->fetch_object())   {
        $listado[] = $row;
    }
    $mysqli->close();
    return $listado;
}


/* funcion que ejecuta una campanna segun su id */
 function EjecutaCampaign($id){
    $sql = "SELECT * FROM campannas_formulario WHERE id='$id'";
    $model = get_listado($sql);
    if(is_numeric($model[0]->id_tb_pagina_captura) && ($model[0]->id_tb_pagina_captura != 0) ){
        $idpagina = $model[0]->id_tb_pagina_captura;
        $sqlpage = "SELECT * FROM pagina_captura WHERE id='$idpagina'";
        $pagina = get_listado($sqlpage);
        //buscando los contactos
        $sqlcontact = "SELECT * FROM contactos WHERE id_pagina_captura='$idpagina'";
        $contactos = get_listado($sqlcontact);
        $body = $pagina[0]->titulo_es.'</br>'.'<label>'.$pagina[0]->contenido_es.'</br>'.$pagina[0]->titulo_en.'</br>'.'<label>'.$pagina[0]->contenido_en.'</br>'.$model[0]->contenido_publicidad;
        $title = $pagina[0]->titulo_en;
    }
    else{
        $body = $model[0]->contenido_publicidad."</br>";
        $title = "Avisos de Cursos y Otros (Pondernet)";
        $sqlcontact = "SELECT * FROM contactos WHERE 1";
        $contactos = get_listado($sqlcontact);
    }
    /* se envia el mail para todos los contactos de esa lista */
    foreach($contactos as $key){
        EnvioMail($key->email,$body,$title,$key->nombre,$model[0]->nombre_campanna);
        //echo ('-'.$key->email.$body.$title.$key->nombre.$model[0]->nombre_campanna.'</br>');
    }
}

/* funcion para enviar correos */
function EnvioMail($mailadrress,$body,$title,$nombre,$campanna){

        $mail = new MyPHPMailer();
//Luego tenemos que iniciar la validación por SMTP:
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.1and1.es"; // A RELLENAR. Aquí pondremos el SMTP a utilizar. Por ej. mail.midominio.com
        $mail->Username = "info@pondernet.com"; // A RELLENAR. Email de la cuenta de correo. ej.info@midominio.com La cuenta de correo debe ser creada previamente.
        $mail->Password = "pondernetcorreo"; // A RELLENAR. Aqui pondremos la contraseña de la cuenta de correo
        $mail->Port = 25; // Puerto de conexión al servidor de envio.
        $mail->From = 'info@pondernet.com'; // A RELLENARDesde donde enviamos (Para mostrar). Puede ser el mismo que el email creado previamente.
        $mail->FromName = 'Pondernet Correo Robot'; //A RELLENAR Nombre a mostrar del remitente.
        $mail->AddAddress($mailadrress); // Esta es la dirección a donde enviamos
        $mail->IsHTML(true); // El correo se envía como HTML
        $mail->Subject = html_entity_decode($title); // Este es el titulo del email.
        $html = $nombre.'</br>'.$campanna;
        $mail->Body = $html.$body; // Mensaje a enviar.
        $exito = $mail->Send(); // Envía el correo.
        if ($exito == '1')    {
            var_dump(true);
        }
        else    {
            echo $error = $mail->ErrorInfo;
        }
}



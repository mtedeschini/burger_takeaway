<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class ControladorWebContacto extends Controller
{

    public function index()
    {

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.contacto', compact('aSucursales'));
    }

}

$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = env('MAIL_HOST');
$mail->SMTPAuth = true;
$mail->Username = env('MAIL_USERNAME');
$mail->Password = env('MAIL_PASSWORD');
$mail->SMTPSecure = env('MAIL_ENCRYPTION');
$mail->Port = env('MAIL_PORT');

//Destinatarios
$mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')); //Dirección desde
$mail->addAddress($email); //Dirección para
$mail->addReplyTo($replyTo); //Dirección de reply no-reply
$mail->addBCC($copiaOculta);//Dirección de CCO

//Contenido del mail
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $body;
$mail->send();




?>
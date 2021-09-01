<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;

class ControladorWebContacto extends Controller
{

    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        return view('web.contacto', compact('aSucursales'));
    }

    public function enviarCorreo(Request $request){
        $nombre = $request->input("txtNombre");
        $correo = $request->input("txtCorreo");
        $asunto = $request->input("txtAsunto");
        $mensaje = $request->input("txtMensaje");

        if($nombre != "" && $correo != "" && $mensaje != ""){
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
            $mail->addAddress(env('MAIL_FROM_ADDRESS'));

            //Contenido del mail
            $mail->isHTML(true);
            $mail->Subject = "Se han contactado desde Burger";
            $mail->Body = "
            Nombre: $nombre<br>
            Correo: $correo<br>
            Asunto: $asunto<br>
            Mensaje: $mensaje
            ";
            $mail->send();

        }
    }
}   

?>
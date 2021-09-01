<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Postulacion;
use Illuminate\Http\Request;

class ControladorWebNosotros extends Controller
{

    public function index()
    {
        $postulacion = new Postulacion();
        $aPostulaciones = $postulacion->obtenerTodos();

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.nosotros', compact('aPostulaciones','aSucursales'));
    }

    public function guardarPostulacion(Request $request){
        $nombre = trim($request->input('txtNombre'));
        $apellido = trim($request->input('txtApellido'));
        $localidad = trim($request->input('txtLocalidad'));
        $documento = trim($request->input('txtDni'));
        $correo = trim($request->input('txtCorreo'));
        $telefono = trim($request->input('txtTelefono'));
        if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) { //Se adjunta la imagen
            $nombre = date("Ymdhmsi") . ".pdf";
            $archivo = $_FILES["archivo"]["tmp_name"];
            move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombre"); //guardaelarchivo
            $entidadPostulacion->archivo_cv = $nombre;
        }

        $entidadPostulacion = new Postulacion();
        $entidadPostulacion->nombre = $nombre;
        $entidadPostulacion->apellido = $apellido;
        $entidadPostulacion->localidad = $localidad;
        $entidadPostulacion->documento = $documento;
        $entidadPostulacion->correo = $correo;
        $entidadPostulacion->telefono = $telefono;
        $entidadPostulacion->archivo_cv = $archivo_cv;
        $entidadPostulacion->insertar();

        return redirect('/nosotros');
    }

}

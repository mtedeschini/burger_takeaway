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
        $archivo_cv = "";//$request->input('archivo');

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

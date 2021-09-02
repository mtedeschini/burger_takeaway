<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use App\Entidades\Postulacion;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request){

  /
         //Validación del campo
         $data = $request->validate([
            'txtNombre'=>'required',
            'txtApellido'=>'required',
            'txtTelefono'=>'required',
            'txtCorreo'=>'required',
            'txtDocumento'=>'required',
            'txtLocalidad'=>'required',
            'archivo_cv'=>'required'
        ]);

        $rutaArchivo=$request['archivo_cv']->store('upload_archivo', 'public');
       

        DB::table('postulaciones')->insert(
            [
                'nombre'=>$data['txtNombre'],
                'apellido'=>$data['txtApellido'],
                'telefono'=>$data['txtTelefono'],
                'correo'=>$data['txtCorreo'],
                'documento'=>$data['txtDocumento'],
                'localidad'=>$data['txtLocalidad'],
                'archivo_cv'=>$rutaArchivo
            ]
            );

        return redirect('/nosotros');
    }

}

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

  /*      $entidadPostulacion = new Postulacion();
        $entidadPostulacion->cargarDesdeRequest($request);
        
        $nombre = trim($request->input('txtNombre'));
        $apellido = trim($request->input('txtApellido'));
        $localidad = trim($request->input('txtLocalidad'));
        $documento = trim($request->input('txtDocumento'));
        $correo = trim($request->input('txtCorreo'));
        $telefono = trim($request->input('txtTelefono'));
        $archivo_cv=$request['archivo_cv']->store('documentos', 'public');
        $archivo_cv->save();
        */
        /*if ($_FILES["archivo_cv"]["error"] === UPLOAD_ERR_OK) { //Se adjunta la imagen
            $nombre = date("Ymdhmsi") . ".pdf";
            $archivo_cv = $_FILES["archivo_cv"]["tmp_name"];
            move_uploaded_file($archivo_cv, env('APP_PATH') . "/public/files/$nombre"); //guardaelarchivo
            $entidadPostulacion->archivo_cv = $nombre;
        }*/
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

        $archivo_cv=$request['archivo_cv']->store('documentos','public');
        $archivo_cv->save();

        DB::table('postulaciones')->insert(
            [
                'txtNombre'=>$data['txtNombre'],
                'txtApellido'=>$data['txtApellido'],
                'txtTelefono'=>$data['txtTelefono'],
                'txtCorreo'=>$data['txtCorreo'],
                'txtDocumento'=>$data['txtDocumento'],
                'txtLocalidad'=>$data['txtLocalidad'],
                'archivo_cv'=>$archivo_cv]
            );
                

       /* $entidadPostulacion = new Postulacion();
        $entidadPostulacion->nombre = $nombre;
        $entidadPostulacion->apellido = $apellido;
        $entidadPostulacion->localidad = $localidad;
        $entidadPostulacion->documento = $documento;
        $entidadPostulacion->correo = $correo;
        $entidadPostulacion->telefono = $telefono;
        $entidadPostulacion->archivo_cv = $archivo_cv;
        $entidadPostulacion->insertar();*/

        return redirect('/nosotros');
    }

}

<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use App\Entidades\Postulacion;
use Illuminate\Support\Facades\DB;
use App\Entidades\Carrito;
use Session;


class ControladorWebNosotros extends Controller
{

    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $postulacion = new Postulacion();
        $aPostulaciones = $postulacion->obtenerTodos();

        if(Session::get('cliente_id') != ""){
            $carrito = new Carrito();
            $aCarritos = $carrito->obtenerPorCliente(Session::get('cliente_id'));
        
            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();
        
            $productosCarrito = 0;
            foreach ($aCarritos as $item){
                $productosCarrito += $item->cantidad;
            }
        
            return view('web.nosotros', compact('aPostulaciones','aCarritos', 'aSucursales', 'productosCarrito'));
        }
        return view('web.nosotros', compact('aPostulaciones','aSucursales'));    

    }




    public function store(Request $request){

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

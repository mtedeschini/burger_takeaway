<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;
use Illuminate\Http\Request;


require app_path().'/start/constants.php';


class ControladorProducto extends Controller{

    public function index()
    {
        $titulo = "Producto";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PRODUCTOCONSULTA")) {
                $codigo = "PRODUCTOCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('producto.producto-listar', compact('titulo'));
            }
          } else {
            return redirect('admin/login');
        }
    
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Producto();
        $aProductos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aProductos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<img src="/files/'. $aProductos[$i]->imagen .'" class="img-thumbnail">';
            $row[] = '<a href="/admin/producto/' . $aProductos[$i]->idproducto . '">' . $aProductos[$i]->nombre . '</a>';
            $row[] = $aProductos[$i]->precio;
            $row[] = $aProductos[$i]->descripcion;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aProductos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aProductos), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }


    public function nuevo()
    {
        $titulo = "Nuevo Producto";
        $producto = new Producto();

        return view('producto.producto-nuevo', compact('producto', 'titulo'));
    }


    public function editar($id)
    {
        $titulo = "Modificar Producto";
        if (Usuario::autenticado() == true)
        
        {
            if (!Patente::autorizarOperacion("PRODUCTOMODIFICACION")) {
                $codigo = "PRODUCTOMODIFICACION";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $producto = new Producto();
                $producto->obtenerPorId($id);

                return view('producto.producto-nuevo', compact('producto', 'titulo'));
            }
        }   else {
            return redirect('admin/login');
        }
    }

    
    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Pedido::autorizarOperacion("PRODUCTOELIMINAR")) {

          
                $entidad = new Producto();
                $entidad->cargarDesdeRequest($request);
                $entidad->eliminar();

                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            } else {
                $codigo = "ELIMINARPROFESIONAL";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Guardar producto";
            $entidad = new Producto();
            $entidad->cargarDesdeRequest($request);

            if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {//Se adjunta imagen
                $nombre = date("Ymdhmsi") . ".jpg";
                $archivo = $_FILES["archivo"]["tmp_name"];
                move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombre"); //guardaelarchivo
                $entidad->imagen = $nombre;
            }

            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    $productAnt = new Producto();
                    $productAnt->obtenerPorId($entidad->idproducto);

                    if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){
                        //Eliminar imagen anterior
                        @unlink(env('APP_PATH') . "/public/files/$productAnt->imagen");                          
                    } else {
                        $entidad->imagen = $productAnt->imagen;
                    }

                    //Es actualizacion
                    $entidad->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Es nuevo
                    $entidad->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                }
                $_POST["id"] = $entidad->idproducto;
                return view('producto.producto-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idproducto;
        $producto = new Producto();
        $producto->obtenerPorId($id);

        return view('producto.producto-nuevo', compact('msg', 'producto', 'titulo')) . '?id=' . $producto->idproducto;
    }

   public function guardarArchivo(Request $request) {

        $idproducto=$request['id'];
        try {
            //Define la entidad servicio
            $titulo = "Modificar esencia";
            $entidad = new Producto();
            $entidad->cargarDesdeRequest($request);
            $idproducto=$_REQUEST['id'];
    
        if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK)
    {
        $nombre = date("Ymdhmsi") . ".jpg"; 
        $archivo = $_FILES["archivo"]["tmp_name"];
        move_uploaded_file($archivo, env('APP_PATH') . "/Users/nelson/Desktop/Proyectos FS/broker-seguros");//guardaelarchivo
        $entidad->imagen =$nombre;
    }   
    //validaciones
    if ($entidad->nombre == "") {
        $msg["ESTADO"] = MSG_ERROR;
        $msg["MSG"] = "Complete todos los datos";
    } else {
        if ($_POST["id"] > 0) {
            $productoAnt = new Producto();
            $productoAnt->obtenerPorId($entidad->idproducto);
       
            if(isset($_FILES["archivo"]) && $_FILES["archivo"]["name"] != ""){
                $archivoAnterior =$_FILES["archivo"]["name"];
                if($archivoAnterior !=""){
                    @unlink (env('APP_PATH') . "/Users/nelson/Desktop/Proyectos FS/broker-seguros");
                }
            } else {
                $entidad->imagen = $productAnt->imagen;
            }

         //Es actualizacion
         $entidad->guardar();

         $msg["ESTADO"] = MSG_SUCCESS;
         $msg["MSG"] = OKINSERT;
     }  else {
         //Es nuevo
         $entidad->insertar();

         $msg["ESTADO"] = MSG_SUCCESS;
         $msg["MSG"] = OKINSERT;
     }
   
     $_POST["id"] = $entidad->idproducto;
     return view('producto.producto-listar', compact('titulo', 'msg'));
 }
    }      catch (Exception $e) {
        $msg["ESTADO"] = MSG_ERROR;
    $msg["MSG"] = ERRORINSERT;


   }
   }
    
}
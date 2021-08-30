<?php

namespace App\Http\Controllers;

use App\Entidades\Promo;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;
use Illuminate\Http\Request;


require app_path().'/start/constants.php';


class ControladorPromo extends Controller{

    public function index()
    {
        $titulo = "Promo";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PROMOCONSULTA")) {
                $codigo = "PROMOOCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('promo.promo-listar', compact('titulo'));
            }
          } else {
            return redirect('admin/login');
        }
    
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Promo();
        $aPromos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aPromos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<img src="/files/'. $aPromos[$i]->imagen .'" class="img-thumbnail">';
            $row[] = '<a href="/admin/promo/' . $aPromos[$i]->idpromo . '">' . $aPromos[$i]->nombre . '</a>';
            $row[] = $aPromos[$i]->precio;
            $row[] = $aPromos[$i]->descripcion;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aPromos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPromos), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }


    public function nuevo()
    {
        $titulo = "Nuevo Promo";
        $promo = new Promo();

        return view('promo.promo-nuevo', compact('promo', 'titulo'));
    }


    public function editar($id)
    {
        $titulo = "Modificar Promo";
        if (Usuario::autenticado() == true)
        
        {
            if (!Patente::autorizarOperacion("MENUMODIFICACION")) {
                $codigo = "MENUMODIFICACION";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $promo = new Promo();
                $promo->obtenerPorId($id);

                return view('promo.promo-nuevo', compact('promo', 'titulo'));
            }
        }   else {
            return redirect('admin/login');
        }
    }

    

    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("MENUELIMINAR")) {

          
                $entidad = new Promo();
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
            $titulo = "Guardar promo";
            $entidad = new Promo();
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
                    $promAnt = new Promo();
                    $promAnt->obtenerPorId($entidad->idpromo);

                    if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){
                        //Eliminar imagen anterior
                        @unlink(env('APP_PATH') . "/public/files/$promAnt->imagen");                          
                    } else {
                        $entidad->imagen = $promAnt->imagen;
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
                $_POST["id"] = $entidad->idpromoo;
                return view('promo.promo-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idpromo;
        $promo = new Promo();
        $promo->obtenerPorId($id);

        return view('promo.promo-nuevo', compact('msg', 'promo', 'titulo')) . '?id=' . $promo->idpromo;
    }

   public function guardarArchivo(Request $request) {

        $idpromo=$request['id'];
        try {
            //Define la entidad servicio
            $titulo = "Modificar esencia";
            $entidad = new Promo();
            $entidad->cargarDesdeRequest($request);
            $idpromo=$_REQUEST['id'];
    
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
            $promoAnt = new Promo();
            $promoAnt->obtenerPorId($entidad->idpromo);
       
            if(isset($_FILES["archivo"]) && $_FILES["archivo"]["name"] != ""){
                $archivoAnterior =$_FILES["archivo"]["name"];
                if($archivoAnterior !=""){
                    @unlink (env('APP_PATH') . "/Users/nelson/Desktop/Proyectos FS/broker-seguros");
                }
            } else {
                $entidad->imagen = $promAnt->imagen;
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
   
     $_POST["id"] = $entidad->idpromo;
     return view('promo.promo-listar', compact('titulo', 'msg'));
 }
    }      catch (Exception $e) {
        $msg["ESTADO"] = MSG_ERROR;
    $msg["MSG"] = ERRORINSERT;


   }
   }
    
}
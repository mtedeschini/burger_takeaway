<?php

namespace App\Http\Controllers;

use App\Entidades\Postulacion;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';


class ControladorPostulacion extends Controller{

    public function index()
    {
        $titulo = "Postulaciones";
        if (Usuario::autenticado() == true) {
            return view('postulacion.postulacion-listar', compact('titulo'));
        } else {
            return redirect('admin/login');
        }

    }
    

    public function nuevo()
    {
        $titulo = "Nueva Postulacion";
        $postulacion = new Postulacion();

        return view('postulacion.postulacion-nuevo', compact('postulacion', 'titulo'));

    }
    public function editar($id)
    {
        $titulo = "Modificar Postulacion";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MENUMODIFICACION")) {
                $codigo = "MENUMODIFICACION";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $postulacion = new Postulacion();
                $postulacion->obtenerPorId($id);

                return view('postulacion.postulacion-nuevo', compact('postulacion', 'titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Postulacion();
        $aPostulaciones = $entidad->obtenerFiltrado(); 

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aPostulaciones) && $cont < $registros_por_pagina; $i++) {
            $row = array();

            $row[] = '<a href="/admin/postulacion/' . $aPostulaciones[$i]->idpostulacion . '" class="btn btn-secondary"><i class="fas fa-search"></i></a>';

            $row[] = $aPostulaciones[$i]->nombre;
            $row[] = $aPostulaciones[$i]->apellido;
            $row[] = $aPostulaciones[$i]->localidad;
            $row[] = $aPostulaciones[$i]->documento;
            $row[] = $aPostulaciones[$i]->correo;
            $row[] = $aPostulaciones[$i]->telefono;
            $row[] = $aPostulaciones[$i]->archivo_cv;

           
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),

            "recordsTotal" => count($aPostulaciones), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPostulaciones), //cantidad total de registros en la paginacion
            
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function guardar(Request $request) {
        $idpostulacion=$request['id'];
        try {
            //Define la entidad 
            $titulo = "Modificar Postulacion";
            $entidad = new Postulacion();
            $entidad->cargarDesdeRequest($request);
            $idpostulacion=$_REQUEST['id'];

            if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK)
            {
                $nombre = date("Ymdhmsi") . ".pdf"; 
                $archivo = $_FILES["archivo"]["tmp_name"];
                move_uploaded_file($archivo, env('APP_PATH') . "public/images/$nombre");//guardaelarchivo
                $entidad->imagen =$nombre;
            }   
            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    $postulacionAnt = new Postulacion();
                    $postulacionAnt->obtenerPorId($entidad->idpostulacion);

                    if(isset($_FILES["archivo"]) && $_FILES["archivo"]["name"] != ""){
                        //Eliminar imagen anterior

                        //Setear nueva imagen
                        $archivoAnterior =$_FILES["archivo"]["name"];
                        if($archivoAnterior !=""){
                            @unlink (env('APP_PATH') . "public/images/$archivoAnterior");
                        }
                    } else {
                        $entidad->imagen = $postulacionAnt->imagen;
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
                
                $_POST["id"] = $entidad->idpostulacion;
                return view('postulacion.postulacion-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idpostulacion;
        $postulacion = new Postulacion();
        $postulacion->obtenerPorId($id);

    
        return view('postulacion.postulacion-nuevo', compact('msg', 'titulo',)) . '?id=' . $postulacion->idpostulacion;

    }







}




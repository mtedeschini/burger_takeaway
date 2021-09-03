<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Postulacion;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Support\Facades\DB;

require app_path() . '/start/constants.php';


class ControladorPostulacion extends Controller
{

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
    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("MENUELIMINAR")) {


                $entidad = new Postulacion();
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
            $row[] = '<a href="/files/' . $aPostulaciones[$i]->archivo_cv . '" class="btn btn-secondary"><i class="far fa-file-pdf"></i></a>';


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

    public function guardar(Request $request)
    {
        $idpostulacion = $request['id'];
        try {
            //Define la entidad 
            $titulo = "Modificar Postulacion";
            $entidad = new Postulacion();
            $entidad->cargarDesdeRequest($request);

            if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) { //Se adjunta la imagen
                $nombre = date("Ymdhmsi") . ".pdf";
                $archivo = $_FILES["archivo"]["tmp_name"];
                move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombre"); //guardaelarchivo
                $entidad->archivo_cv = $nombre;
            }
            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    $postulacionAnt = new Postulacion();
                    $postulacionAnt->obtenerPorId($entidad->idpostulacion);

                    if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
                        //Eliminar imagen anterior
                        @unlink(env('APP_PATH') . "/public/files/$productAnt->archivo_cv");
                    } else {
                        $entidad->archivo_cv = $productAnt->archivo_cv;
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

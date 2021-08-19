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
        return view('postulacion.postulacion-nuevo', compact('titulo'));

    }

    public function guardar(Request $request) {
        try {
            //Define la entidad servicio
            $titulo = "Modificar Postulacion";
            $entidad = new Postulacion();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
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




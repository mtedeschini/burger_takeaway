<?php

namespace App\Http\Controllers;

use App\Entidades\Sponsor;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';


class ControladorSponsor extends Controller{

    

     public function index()
    {
        $titulo = "Sponsors";;
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                $codigo = "MENUCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('sponsor.sponsor-listar', compact('titulo'));  
            }
        } else {
            return redirect('admin/login');
        }
    }
    

    public function nuevo()
    {
        $titulo = "Nuevo Sponsor";
        $sponsor = new Sponsor(); // ???

        return view('sponsor.sponsor-nuevo', compact('sponsor', 'titulo'));

    }
    public function editar($id)
    {
        $titulo = "Modificar Sponsor";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MENUMODIFICACION")) {
                $codigo = "MENUMODIFICACION";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo',  'codigo', 'mensaje'));
            } else {
                $sponsor = new Sponsor();
                $sponsor->obtenerPorId($id);

                return view('sponsor.sponsor-nuevo', compact('sponsor', 'titulo'));
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

                $entidad = new Sponsor();
                $entidad->cargarDesdeRequest($request);
                $entidad->eliminar();

                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            } else {
                $codigo = "ELIMINARSPONSOR";
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

        $entidad = new Sponsor();
        $aSponsors = $entidad->obtenerFiltrado(); 

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aSponsors) && $cont < $registros_por_pagina; $i++) {
            $row = array();

            $row[] = '<a href="/admin/sponsors/' . $aSponsors[$i]->idsponsor . '" class="btn btn-secondary"><i class="fas fa-search"></i></a>';

            $row[] = $aSponsors[$i]->nombre_empresa;
            $row[] = $aSponsors[$i]->nombre_producto;
            $row[] = $aSponsors[$i]->descripcion;
            $row[] = $aSponsors[$i]->cantidad_producto;
            $row[] = $aSponsors[$i]->email;
            $row[] = $aSponsors[$i]->telefono;
            $row[] = '<img src="/files/'. $aSponsors[$i]->foto_producto .'" class="img-thumbnail">';
           

            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),

            "recordsTotal" => count($aSponsors), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aSponsors), //cantidad total de registros en la paginacion
            
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function guardar(Request $request) {
        $idsponsor=$request['id'];
        try {
            //Define la entidad 
            $titulo = "Modificar Sponsors";
            $entidad = new Sponsor();
            $entidad->cargarDesdeRequest($request);

            if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK)
            {//Se adjunta la imagen
                $nombre = date("Ymdhmsi") . ".jpg"; 
                $archivo = $_FILES["archivo"]["tmp_name"];
                move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombre");//guardaelarchivo
                $entidad->foto_producto =$nombre;
            }  
            //validaciones
            if ($entidad->nombre_producto == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    $sponsorAnt = new Sponsor();
                    $sponsorAnt->obtenerPorId($entidad->idsponsor);

                    if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){
                        //Eliminar imagen anterior
                        @unlink(env('APP_PATH') . "/public/files/$sponsorAnt->foto_producto");                          
                    } else {
                        $entidad->foto_producto = $sponsorAnt->foto_producto;
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
                
                $_POST["id"] = $entidad->idsponsor;
                return view('sponsor.sponsor-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idsponsor;
        $sponsor = new Sponsor();
        $sponsor->obtenerPorId($id);

        return view('sponsor.sponsor-nuevo', compact('msg', 'titulo',)) . '?id=' . $sponsor->idsponsor;

    }

}
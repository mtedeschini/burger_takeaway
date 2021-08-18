<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;
use App\Entidades\Pedido_detalle;
use App\Entidades\Producto;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorPedido extends Controller
{
    public function index()
    {
        $titulo = "Pedidos";
        if (Usuario::autenticado() == true) {
            return view('pedido.pedido-listar', compact('titulo'));
        } else {
            return redirect('admin/login');
        }
    }

    public function nuevo()
    {
        $titulo = "Nuevo Pedido";
        $entidadSucursal = new Sucursal();
        $aSucursales = $entidadSucursal->obtenerTodos();
        return view('pedido.pedido-nuevo', compact('titulo', 'aSucursales'));
    }

    public function guardar(Request $request){
        try {
            //Define la entidad servicio
            $titulo = "Pedido";
            $entidadPedido = new Pedido();
            $entidadPEdido->cargarDesdeRequest($request);

            //validaciones
            if ($entidadUsuario->usuario == "" || $entidadUsuario->mail == "" || $entidadUsuario->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = USUARIOFALTACAMPOS;
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $entidadUsuario->guardar();

                    //Actualiza en datos personales
                    //$legajo = new Personal();
                    //$legajo->guardarDesdeUsuario($entidadUsuario);

                } else {
                    //Inserta en datos personales
                    //$legajo = new Personal();
                    //$legajo->insertarDesdeUsuario($entidadUsuario);

                    //Es nuevo
                    //$entidadUsuario->fk_idlegajo = $legajo->idlegajo;
                    $entidadUsuario->insertar();
                    $_POST["id"] = $entidadUsuario->idusuario;
                }

                if (Patente::autorizarOperacion("USUARIOAGREGARPERMISO")) {

                    //Guarda las patentes de la familia
                    $familiaUsuario = new Usuario_familia();

                    //Elimina todos las familias del usuario
                    $aFamiliaAsignados = $familiaUsuario->eliminarPorUsuario($entidadUsuario->idusuario);

                    //Obtiene las familias a asignar al usuario
                    $aFamiliaSinAsignar = array();
                    foreach ($_POST as $nombre => $valor) {
                        if (substr($nombre,0,12) == "chk_Familia_") {
                        	$idCompuesto = explode("_", substr($nombre,12,strlen($nombre)));
                            $idFamilia = $idCompuesto[0];
                            $idArea = $idCompuesto[1];
                            $familiaUsuario->fk_idfamilia = $idFamilia;
                            $familiaUsuario->fk_idarea = $idArea;
                            $familiaUsuario->fk_idusuario = $entidadUsuario->idusuario;
                        	$familiaUsuario->insertar();
                        }
                    }
                }
                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = OKINSERT;
                return view('sistema.listar', compact('titulo', 'msg'));
            }
            $usuario = new Usuario();
            $usuario->obtenerPorUsuario($request->input('txtUsuario'));
            //return view('sistema.nuevo-usuario', compact('msg', 'usuario')) . '?id' . $request->input('txtUsuario');

            $area = new Area();
            $array_area =  $area->obtenerTodos();

            $grupo = new Area();
            $array_grupo = $grupo->obtenerTodos();

            return view('sistema.nuevo-usuario', compact('array_area','msg','usuario', 'array_grupo')). '?id' . $request->input('txtUsuario');
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }                
    }

}


?>
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
            $entidadPedido->cargarDesdeRequest($request);

            //validaciones
            if (($entidadPedido->total == "" || $entidadPedido->fk_idsucursal == "") || ($entidadUsuario->fk_idcliente == "") || ($entidadPedido->fk_estadoPago == "") || ($entidadPedido->fk_estado == "") || ($entidadPago->fecha == "")){
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = USUARIOFALTACAMPOS;
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $entidadPedido->guardar();

                    //Actualiza en datos personales
                    //$legajo = new Personal();
                    //$legajo->guardarDesdeUsuario($entidadUsuario);

                } else {
                    //Inserta en datos personales
                    //$legajo = new Personal();
                    //$legajo->insertarDesdeUsuario($entidadUsuario);

                    //Es nuevo
                    //$entidadUsuario->fk_idlegajo = $legajo->idlegajo;
                    $entidadPedido->insertar();
                    $_POST["id"] = $entidadPedido->idpedido;
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
    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Pedido();
        $aPedidos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aPedidos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/pedidos/' . $aPedidos[$i]->idpedido . '">' . $aPedidos[$i]->idpedido . '</a>';
            $row[] = $aPedidos[$i]->total;
            $row[] = $aPedidos[$i]->fk_idsucursal;
            $row[] = $aPedidos[$i]->fk_idcliente;
            $row[] = $aPedidos[$i]->fk_idestado;
            $row[] = $aPedidos[$i]->fk_idestadopago;
            $row[] = $aPedidos[$i]->fecha;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aPedidos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPedidos), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

}




?>
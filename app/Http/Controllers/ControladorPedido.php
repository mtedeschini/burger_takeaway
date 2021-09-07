<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;
use App\Entidades\Pedido_detalle;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use App\Entidades\EstadoPago;
use App\Entidades\Estado;
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
        $entidadEstadoPago = new EstadoPago();
        $entidadEstado = new Estado();
        $entidadCliente = new Cliente();
        $pedido = new Pedido();
        $aClientes = $entidadCliente->obtenerTodos();
        $aEstadoPagos = $entidadEstadoPago->obtenerTodos();
        $aEstados = $entidadEstado->obtenerTodos();
        $aSucursales = $entidadSucursal->obtenerTodos();
        return view('pedido.pedido-nuevo', compact('titulo', 'aSucursales', 'aClientes', 'aEstadoPagos', 'aEstados','pedido'));
    }
    

    public function guardar(Request $request){
        try {
            //Define la entidad servicio
            $titulo = "Modificar Pedido";
            $entidadPedido = new Pedido();
            $entidadPedido->cargarDesdeRequest($request);

            //validaciones
            if ($entidadPedido->total == ""){
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $entidadPedido->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                    
                } else {
                    //es nuevo
                    $entidadPedido->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;        
                }

            
                $_POST["id"] = $entidadPedido->idpedido;
                return view('pedido.pedido-listar', compact('titulo','msg',));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }  
        
        $id = $entidadPedido->idpedido;
        $pedido = new Pedido();
    
        $pedido->obtenerPorId($id);

        return view('pedido.pedido-nuevo', compact('msg', 'pedido', 'titulo')) . '?id=' . $pedido->idpedido;
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
            $row[] = '<a href="/admin/pedido/' . $aPedidos[$i]->idpedido . '" class="btn btn-secondary"><i class="fas fa-search"></i></a>';
            $row[] = $aPedidos[$i]->total;
            $row[] = $aPedidos[$i]->sucursal;
            $row[] = $aPedidos[$i]->cliente;
            $row[] = $aPedidos[$i]->estado;
            $row[] = $aPedidos[$i]->estado_pago;
            $row[] = date_format(date_create($aPedidos[$i]->fecha), 'd/m/Y H:i');
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


    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("MENUELIMINAR")) {

          
                $entidad = new Pedido();
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


    
    public function editar($id)
    {
        $titulo = "Modificar Pedido";
        if (Usuario::autenticado() == true)
        {
            $pedido = new Pedido();
            
            $sucursal = new Sucursal();
            $estadoPago = new EstadoPago();
            $estado = new Estado();
            $cliente = new Cliente();
            $pedidoDetalle = new Pedido_detalle();
            $pedido->obtenerPorId($id);
            $aClientes = $cliente->obtenerTodos();
            $aEstadoPagos = $estadoPago->obtenerTodos();
            $aEstados = $estado->obtenerTodos();
            $aPedidoDetalles = $pedidoDetalle->obtenerPorPedido($id);
            $aSucursales = $sucursal->obtenerTodos();
            return view('pedido.pedido-nuevo', compact('titulo','pedido','aSucursales', 'aClientes', 'aEstadoPagos', 'aEstados', 'aPedidoDetalles'));
        }   else {
            return redirect('admin/login');
        }
    }

}

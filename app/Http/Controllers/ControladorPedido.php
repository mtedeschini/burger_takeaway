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
<?php

namespace App\Http\Controllers;

use App\Entidades\Cliente;
use App\Entidades\Producto;
use App\Entidades\Sucursal;

class ControladorWebCarrito extends Controller {

    public function index() {
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();
        return view('web.carrito', compact('aProductos'));
    }

    public function nuevo() {
        $titulo = "Pedido de carrito";
        $entidadSucursal = new Sucursal();
        $entidadCliente = new Cliente();
        $aClientes = $entidadCliente->obtenerTodos();
        $aSucursales = $entidadSucursal->obtenerTodos();
        return view('pedido.pedido-nuevo', compact('titulo', 'aSucursales', 'aClientes'));
    }



}
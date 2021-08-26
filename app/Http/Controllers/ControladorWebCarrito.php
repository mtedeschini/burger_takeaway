<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
use App\Entidades\Sucursal;

class ControladorWebCarrito extends Controller {

    public function index() {
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();
        return view('web.carrito', compact('aProductos'));
    }


}
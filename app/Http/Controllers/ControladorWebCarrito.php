<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;

class ControladorWebCarrito extends Controller {

    public function index() {
        $producto = new Producto();
        $aProductos = $producto->obtenerPorId();
        return view('web.carrito', compact('aProductos'));
    }

}
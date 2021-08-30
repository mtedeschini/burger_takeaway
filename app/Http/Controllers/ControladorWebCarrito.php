<?php

namespace App\Http\Controllers;

use App\Entidades\Carrito;
use App\Entidades\Sucursal;

class ControladorWebCarrito extends Controller {

    public function index() {
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorUsuario();

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.carrito', compact('aCarritos', 'aSucursales'));
    }


}
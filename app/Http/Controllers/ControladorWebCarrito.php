<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
use App\Entidades\Sucursal;

class ControladorWebCarrito extends Controller {

    public function index() {
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.carrito', compact('aProductos', 'aSucursales'));
    }

    public function finalizarPedido(Request $request){
        //Obtener de la BBDD el carrito actual del usuario

        //Preparar la transaccion con mercadopago



    }


}
<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;

use App\Entidades\Producto;
class ControladorWebTakeaway extends Controller
{

    public function index()
    {   
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();


        return view('web.takeaway', compact('aProductos', 'aSucursales'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
class ControladorWebTakeaway extends Controller
{

    public function index()
    {   
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();
        return view('web.takeaway', compact('aProductos'));
    }

}

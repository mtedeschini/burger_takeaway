<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;

class ControladorWebRecibido extends Controller
{

    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.recibido', compact('aSucursales'));
    }


    

}

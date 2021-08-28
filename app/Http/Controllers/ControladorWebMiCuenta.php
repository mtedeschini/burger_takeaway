<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;

class ControladorWebMiCuenta extends Controller
{

    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.mi-cuenta', compact('aSucursales'));
    }

}

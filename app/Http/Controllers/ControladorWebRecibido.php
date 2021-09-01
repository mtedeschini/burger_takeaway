<?php

namespace App\Http\Controllers;

class ControladorWebRecibido extends Controller
{

    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.nosotros', compact('aPostulaciones','aSucursales'));
    }


    

}

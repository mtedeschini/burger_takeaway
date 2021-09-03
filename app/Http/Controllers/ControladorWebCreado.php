<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;

class ControladorWebCreado extends Controller
{

    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.creado', compact('aSucursales'));
    }


    

}

<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Postulacion;

class ControladorWebNosotros extends Controller
{

    public function index()
    {
        $postulacion = new Postulacion();
        $aPostulaciones = $postulacion->obtenerTodos();

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.nosotros', compact('aPostulaciones','aSucursales'));
    }

}

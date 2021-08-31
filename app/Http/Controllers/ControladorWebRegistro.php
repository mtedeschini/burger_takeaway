<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;

class ControladorWebRegistro extends Controller
{
    public function index()
    {
      $sucursal = new Sucursal();
      $aSucursales = $sucursal->obtenerTodos();

      return view('web.registro', compact('aSucursales'));
    }

}

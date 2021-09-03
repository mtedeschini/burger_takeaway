<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use Session;

class ControladorWebSponsor extends Controller
{

    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        
        return view('web.sponsor', compact( 'aSucursales'));
    }

}
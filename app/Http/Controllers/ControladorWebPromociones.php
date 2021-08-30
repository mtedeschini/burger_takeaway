<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Promo;
class ControladorWebPromociones extends Controller
{

    public function index()
    {   
        $promo = new Promo();
        $aPromos = $promo->obtenerTodos();

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.promociones', compact('aPromos', 'aSucursales'));
    }

}



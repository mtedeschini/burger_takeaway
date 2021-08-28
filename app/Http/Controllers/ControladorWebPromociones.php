<?php

namespace App\Http\Controllers;

use App\Entidades\Promo;
class ControladorWebPromociones extends Controller
{

    public function index()
    {   
        $promo = new Promo();
        $aPromos = $promo->obtenerTodos();
        return view('web.promociones', compact('aPromos'));
    }

}



<?php

namespace App\Http\Controllers;

use App\Entidades\Promo;
class ControladorWebpromociones extends Controller
{

    public function index()
    {   
        $promo = new Promo();
        $apromos = $promo->obtenerTodos();
        return view('web.promociones', compact('aPromos'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Entidades\Promo;
class ControladorWebTakeaway extends Controller
{

    public function index()
    {   
        $promo = new Promo();
        $aPromos = $promo->obtenerTodos();
        return view('web.takeaway', compact('aProductos'));
    }

}

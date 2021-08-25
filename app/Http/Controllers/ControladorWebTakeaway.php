<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
class ControladorWebTakeaway extends Controller
{

    public function index()
    {
        return view('web.takeaway');
    }

}

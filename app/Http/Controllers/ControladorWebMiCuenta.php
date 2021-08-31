<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Session;
class ControladorWebMiCuenta extends Controller
{

    public function index()
    {
        if(Session::get('cliente_id') != ""){
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.mi-cuenta', compact('aSucursales'));
        } else {
            return redirect('/login');
        }
    }

}

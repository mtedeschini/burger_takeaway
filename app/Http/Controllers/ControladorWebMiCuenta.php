<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use Session;
class ControladorWebMiCuenta extends Controller
{

    public function index()
    {
        if(Session::get('cliente_id') != ""){  
            $sucursal = new Sucursal();
            $cliente = new Cliente();
            $aClientes = $cliente->obtenerTodos();
            $aSucursales = $sucursal->obtenerTodos();

        return view('web.mi-cuenta', compact('aSucursales','aClientes'));
        } else {
            return redirect('/login');
        }
    }

}

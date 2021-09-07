<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Carrito;
use Session;
use App\Entidades\Sucursal;

class ControladorWebHome extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        if(Session::get('cliente_id') != ""){
            $carrito = new Carrito();
            $aCarritos = $carrito->obtenerPorCliente(Session::get('cliente_id'));
        
            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();
        
            $productosCarrito = 0;
            foreach ($aCarritos as $item){
                $productosCarrito += $item->cantidad;
            }
        
            return view('web.index', compact('aCarritos', 'aSucursales', 'productosCarrito'));
        }
        return view('web.index', compact('aSucursales'));    

    }
}

<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Carrito;

use Session;


class ControladorWebCreado extends Controller
{

    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        
        if(Session::get('cliente_id') != ""){
            
            $entidadCarrito = new Carrito();
            $aCarritos = $entidadCarrito->obtenerPorCliente(Session::get('cliente_id'));
            $productosCarrito = 0;
            foreach ($aCarritos as $item){
                $productosCarrito += $item->cantidad;
            }
            return view('web.creado', compact('aSucursales', 'aCarritos', 'total'));
        }
        return view('web.login', compact('aSucursales'));

    } 
    

    

}

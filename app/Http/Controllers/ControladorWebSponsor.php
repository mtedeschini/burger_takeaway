<?php

namespace App\Http\Controllers;

use App\Entidades\Sponsor;
use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use Illuminate\Http\Request;
use Session;

class ControladorWebSponsor extends Controller
{
    public function index()
    {
        $titulo = "Listado Sponsors";
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $sponsor = new Sponsor();
        $aSponsors = $sponsor->obtenerTodos();

        if(Session::get('cliente_id') != ""){
            $carrito = new Carrito();
            $aCarritos = $carrito->obtenerPorCliente(Session::get('cliente_id'));
               
            $productosCarrito = 0;
            foreach ($aCarritos as $item){
                $productosCarrito += $item->cantidad;
            }
        
            return view('web.sponsor', compact('aCarritos', 'aSucursales', 'titulo', 'aSponsors', 'productosCarrito'));
        }
        return view('web.sponsor', compact('aSucursales', 'titulo', 'aSponsors'));    

    }

}
<?php

namespace App\Http\Controllers;

use App\Entidades\Sponsor;
use App\Entidades\Sucursal;
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
        
        return view('web.sponsor', compact( 'titulo','aSucursales', 'aSponsors'));
    }

}
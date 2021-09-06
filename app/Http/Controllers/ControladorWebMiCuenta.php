<?php

namespace App\Http\Controllers;
use App\Entidades\Cliente;
use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use Session;
class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
        if(Session::get('cliente_id') != ""){
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente(Session::get('cliente_id'));

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $productosCarrito = 0;
        foreach ($aCarritos as $item){
            $productosCarrito += $item->cantidad;
        }

        $cliente = new Cliente();
        $cliente->obtenerPorId(Session::get("cliente_id"));

        return view('web.mi-cuenta', compact('aCarritos', 'aSucursales', 'productosCarrito', 'cliente'));
        } else {
            return redirect("/login");
        }
    }

}

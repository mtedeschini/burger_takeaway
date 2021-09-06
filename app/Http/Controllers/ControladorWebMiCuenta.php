<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
<<<<<<< HEAD
use App\Entidades\Cliente;
=======
use App\Entidades\Carrito;
>>>>>>> 3c1e3e91466d8b64c3fe957a11d577c6b3046bd1
use Session;
class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        if(Session::get('cliente_id') != ""){  
            $sucursal = new Sucursal();
            $cliente = new Cliente();
            $aClientes = $cliente->obtenerTodos();
            $aSucursales = $sucursal->obtenerTodos();

        return view('web.mi-cuenta', compact('aSucursales','aClientes'));
=======
        if(Session::get('cliente_id') != ""){
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente(Session::get('cliente_id'));

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $productosCarrito = 0;
        foreach ($aCarritos as $item){
            $productosCarrito += $item->cantidad;
        }

        return view('web.mi-cuenta', compact('aCarritos', 'aSucursales', 'productosCarrito'));
>>>>>>> 3c1e3e91466d8b64c3fe957a11d577c6b3046bd1
        } else {
            return redirect("/login");
        }
    }

}

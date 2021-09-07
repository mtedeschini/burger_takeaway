<?php

namespace App\Http\Controllers;

use App\Entidades\Carrito;
use App\Entidades\Producto;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use Session;

class ControladorWebTakeaway extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();

        if(Session::get('cliente_id') != ""){
            $carrito = new Carrito();
            $aCarritos = $carrito->obtenerPorCliente(Session::get('cliente_id'));
        
            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();
        
            $productosCarrito = 0;
            foreach ($aCarritos as $item){
                $productosCarrito += $item->cantidad;
            }
        
            return view('web.takeaway', compact('aCarritos', 'aSucursales', 'productosCarrito', 'aProductos'));
        }
        return view('web.takeaway', compact('aSucursales', 'aProductos'));    

    }

    public function guardar(Request $request)
    {
        if(Session::get('cliente_id') != ""){
            $cantidad = $request->input('txtCantidad');
            $idProducto = $request->input('txtProducto');

            $entidadCarrito = new Carrito();
            $entidadCarrito->fk_idproducto = $idProducto;
            $entidadCarrito->cantidad = $cantidad;
            $entidadCarrito->fk_idcliente = Session::get('cliente_id');
            $entidadCarrito->insertar();

            return redirect('/carrito');
        } else {
            return redirect('/login');
        }
    }

}

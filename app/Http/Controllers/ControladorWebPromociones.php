<?php

namespace App\Http\Controllers;

use App\Entidades\Carrito;
use App\Entidades\Producto;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use Session;

class ControladorWebPromociones extends Controller
{

    public function index()
    {
        $producto = new Producto();
        $aProductos = $producto->obtenerPromociones();

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.promociones', compact('aProductos', 'aSucursales'));
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

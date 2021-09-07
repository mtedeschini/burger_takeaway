<?php

namespace App\Http\Controllers;

use App\Entidades\Carrito;
use App\Entidades\Producto;
use App\Entidades\Cliente;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorCarrito extends Controller
{

public function nuevo()
{
    $titulo = "Nuevo Carrito";
    $entidadProducto = new Producto();
    $entidadCliente = new Cliente();
    $carrito = new Carrito();
    $aClientes = $entidadCliente->obtenerTodos();
    $aProductos = $entidadProducto->obtenerTodos();
    return view('carrito.carrito-nuevo', compact('titulo', 'aClientes', 'aProductos', 'carrito'));
}


public function eliminar()
{
    $sql = "DELETE FROM carritos WHERE
        idcarrito=?";
    $affected = DB::delete($sql, [$this->idproducto]);
}
}
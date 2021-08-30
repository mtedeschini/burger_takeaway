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


public function guardar(Request $request){
    try {
        //Define la entidad servicio
        $titulo = "Modificar Carrito";
        $entidadCarrito = new Carrito();
        $entidadCarrito->cargarDesdeRequest($request);

        //validaciones
        if ($entidadCarrito->fk_idproducto == ""){
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = "Complete todos los datos";
        } else {
            if ($_POST["id"] > 0) {
                //Es actualizacion
                $entidadCarrito->guardar();

                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = OKINSERT;
                
            } else {
                //es nuevo
                $entidadCarrito->insertar();

                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = OKINSERT;        
            }

        
            $_POST["id"] = $entidadCarrito->idcarrito;
            return view('carrito.carrito-listar', compact('titulo','msg',));
        }
    } catch (Exception $e) {
        $msg["ESTADO"] = MSG_ERROR;
        $msg["MSG"] = ERRORINSERT;
    }  
    
    $id = $entidadCarrito->idcarrito;
    $carrito = new Carrito();

    $carrito->obtenerPorId($id);

    return view('carrito.carrito-nuevo', compact('msg', 'carrito', 'titulo')) . '?id=' . $carrito->idcarrito;
}        

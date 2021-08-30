<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Producto;
use Illuminate\Http\Request;

class ControladorWebTakeaway extends Controller
{

    public function index()
    {   
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.takeaway', compact('aProductos', 'aSucursales'));
    }


    
    public function guardar(Request $request){
        try {
print_r($_REQUEST);
exit;

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


}

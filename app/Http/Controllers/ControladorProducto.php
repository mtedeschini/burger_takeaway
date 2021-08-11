<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
use App\Entidades\Sistema\Usuario;

class ControladorProducto extends Controller{

    public function index()
    {
        $titulo = "Producto";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PRODUCTOCONSULTA")) {
                $codigo = "PRODUCTOCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('sistema.producto-listar', compact('titulo'));
            }
          } else {
            return redirect('admin/login');
        }
    
    }
    public function nuevo()
    {
        $titulo = "Nuevo Producto";

        $entidad = new Producto();
        $array_menu = $entidad->obtenerMenuPadre();

        return view('sistema.producto-nuevo', compact('titulo', 'array_producto'));

    }
}

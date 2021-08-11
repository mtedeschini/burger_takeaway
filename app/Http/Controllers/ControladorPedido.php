<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;
use App\Entidades\;

use Illuminate\Http\Request;

class ControladorPedido extends Controller
{
    public function index()
    {
        $titulo = "Pedidos";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                $codigo = "MENUCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('pedidos.pedido-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }


    public function nuevo()
    {
        $titulo = "Nuevo Pedido";
        return view('pedidos.pedido-nuevo', compact('titulo'));

    }

}


?>
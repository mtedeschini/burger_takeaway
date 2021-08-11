<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

class ControladorPedido extends Controller
{
    public function index()
    {
        $titulo = "Pedidos";
        if (Usuario::autenticado() == true) {
            return view('pedido.pedido-listar', compact('titulo'));
        } else {
            return redirect('admin/login');
        }
    }


    public function nuevo()
    {
        $titulo = "Nuevo Pedido";
        return view('pedido.pedido-nuevo', compact('titulo'));
    }

}


?>
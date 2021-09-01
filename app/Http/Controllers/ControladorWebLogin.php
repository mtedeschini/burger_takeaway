<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;

class ControladorWebLogin extends Controller
{
    public function index()
    {
      $sucursal = new Sucursal();
      $aSucursales = $sucursal->obtenerTodos();

      return view('web.login', compact('aSucursales'));
    }

    public function ingresar(Request $request){
        $correo = $request->input("txtUsuario");
        $clave = $request->input("txtClave");

        $cliente = new Cliente;
        $cliente->obtenerPorCorreo($correo);

        $cliente->verificarClave($clave, $cliente->clave)

    }
}

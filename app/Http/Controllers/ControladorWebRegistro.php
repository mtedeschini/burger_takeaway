<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Cliente;


class ControladorWebRegistro extends Controller
{
    public function index()
    {
      $sucursal = new Sucursal();
      $aSucursales = $sucursal->obtenerTodos();

      return view('web.registro', compact('aSucursales'));
    }

    public function guardar(Request $request)
    {
        $correo = $request->input('txtCorreo');
        $clave = $request->input(encriptarClave('txtClave')); 
        $nombre = $request->input('txtNombre');
        $apellido = $request->input('txtApellido');
        $telefono = $request->input('txtTelefono');

        $entidadCliente = new Cliente();
        $entidadCliente->correo = $correo;
        $entidadCliente->clave = $clave;
        $entidadCliente->nombre = $nombre;
        $entidadCliente->apellido = $apellido;
        $entidadCliente->telefono = $telefono;
        $entidadCliente->fk_idcliente = "2";
        $entidadCliente->insertar();

        return redirect('/carrito');
    }

}

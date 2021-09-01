<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use Illuminate\Http\Request;


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
        $entidadCliente = new Cliente();

        $correo = trim($request->input('txtCorreo'));
        $clave = $entidadCliente->encriptarClave(trim($request->input('txtClave'))); 
        $nombre = trim($request->input('txtNombre'));
        $apellido = trim($request->input('txtApellido'));
        $telefono = trim($request->input('txtTelefono'));
        
        $entidadCliente->correo = $correo;
        $entidadCliente->clave = $clave;
        $entidadCliente->nombre = $nombre;
        $entidadCliente->apellido = $apellido;
        $entidadCliente->telefono = $telefono;
        $entidadCliente->insertar();

        return redirect('/carrito');
    }

}

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
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $entidadCliente = new Cliente();

        $correo = trim($request->input('txtCorreo'));
        $clave = $entidadCliente->encriptarClave(trim($request->input('txtClave'))); 
        $nombre = trim($request->input('txtNombre'));
        $apellido = trim($request->input('txtApellido'));
        $telefono = trim($request->input('txtTelefono'));
        
        if($entidadCliente->obtenerPorCorreo($correo)){

          $msg["ESTADO"] = "danger";
          $msg["MSG"] = "Ya existe una cuenta con el correo <b>" . $correo;;

          return view("web.registro", compact('msg', 'aSucursales'));
                }
        else{
        $entidadCliente->correo = $correo;
        $entidadCliente->clave = $clave;
        $entidadCliente->nombre = $nombre;
        $entidadCliente->apellido = $apellido;
        $entidadCliente->telefono = $telefono;
        $entidadCliente->insertar();

        $msg["ESTADO"] = "success";
        $msg["MSG"] = "¡Usuario creado exitosamente! Por favor complete sus datos para ingresar.";

        return view("web.creado", compact('aSucursales'));
        ;
      }
    }

}

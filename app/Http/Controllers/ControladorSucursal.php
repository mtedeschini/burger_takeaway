<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Sistema\Usuario;

require app_path() . '/start/constants.php';


class ControladorSucursal extends Controller{

    public function index()
    {
        $titulo = "Sucursales";
        if (Usuario::autenticado() == true) {
            if (!SUCURSAL::autorizarOperacion("SUCURSALCONSULTA")) {
                $codigo = "SUCURSALCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('sucursal.sucursal-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function nuevo()
    {
        $titulo = "Nueva Sucursal";
        if (Usuario::autenticado() == true) {
            if (!Sucursal::autorizarOperacion("SUCURSALALTA")) {
                $codigo = "SUCURSALALTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('sucursal.sucursal-nuevo');
            }
        } else {
            return redirect('admin/login');
        }
    }
}





















?>









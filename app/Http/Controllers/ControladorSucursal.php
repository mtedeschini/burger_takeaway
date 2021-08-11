<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;


class ControladorSucursal extends Controller{










    public function nuevo()
    {
        $titulo = "Nueva Sucursal";
        if (Usuario::autenticado() == true) {
            if (!Sucursal::autorizarOperacion("NUEVASUCURSAL")) {
                $codigo = "NUEVASUCURSAL";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('sistema.sucursal-nuevo');
            }
        } else {
            return redirect('admin/login');
        }
    }


}





















?>









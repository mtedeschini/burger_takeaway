<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;


class ControladorSucursal extends Controller{










    public function nuevo()
    {
        $titulo = "Nueva Sucursal";

        $entidad = new Sucursal();
        $array_menu = $entidad->obtenerMenuPadre();

        return view('sistema.menu-nuevo', compact('titulo', 'array_menu'));

    }


}





















?>









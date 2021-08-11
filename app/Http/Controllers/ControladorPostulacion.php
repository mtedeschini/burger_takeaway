<?php

namespace App\Http\Controllers;

use App\Entidades\Postulacion;


class ControladorPostulacion extends Controller{










    public function nuevo()
    {
        $titulo = "Nueva Postulacion";

        $entidad = new Postulacion();
        $array_menu = $entidad->obtenerMenuPadre();

        return view('sistema.postulacion-nueva', compact('titulo', 'array_postulacion'));

    }


}



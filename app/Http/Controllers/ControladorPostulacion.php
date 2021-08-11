<?php

namespace App\Http\Controllers;

use App\Entidades\Postulacion;


class ControladorPostulacion extends Controller{










    public function nuevo()
    {
        $titulo = "Nueva Postulacion";
        return view('sistema.postulacion-nueva', compact('titulo'));

    }


}



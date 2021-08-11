<?php

namespace App\Http\Controllers;

use App\Entidades\Postulacion;


class ControladorPostulacion extends Controller{










    public function nuevo()
    {
        $titulo = "Nueva Postulacion";
<<<<<<< HEAD
        return view('postulacion.postulacion-nueva', compact('titulo'));
=======
        return view('postulacion.postulacion-nuevo', compact('titulo'));
>>>>>>> ef71684308cbc38673e5a499371d9591f882ddae

    }


}



<?php

namespace App\Http\Controllers;

use App\Entidades\Postulacion;
use App\Entidades\Sistema\Usuario;

require app_path() . '/start/constants.php';


class ControladorPostulacion extends Controller{

    public function index()
    {
        $titulo = "Postulaciones";
        if (Usuario::autenticado() == true) {
            return view('postulacion.postulacion-listar', compact('titulo'));
        } else {
            return redirect('admin/login');
        }

    }
    

    public function nuevo()
    {
        $titulo = "Nueva Postulacion";
        return view('postulacion.postulacion-nuevo', compact('titulo'));

    }


}




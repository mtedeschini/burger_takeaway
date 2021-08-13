<?php

namespace App\Http\Controllers;

use App\Entidades\Postulacion;


class ControladorPostulacion extends Controller{

    public function index()
    {
        $titulo = "Postulacion";
        if (Usuario::autenticado() == true) {
            if (!Postulacion::autorizarOperacion("POSTULACIONCONSULTA")) {
                $codigo = "PRODUCTO CONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('sistema.postulacion-listar', compact('titulo'));
            }
          } else {
            return redirect('admin/login');
        }
    
    }


    public function nuevo()
    {
        $titulo = "Nueva Postulacion";
        return view('postulacion.postulacion-nueva', compact('titulo'));

    }


}



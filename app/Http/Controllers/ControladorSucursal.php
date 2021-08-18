<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;

require app_path() . '/start/constants.php';


class ControladorSucursal extends Controller{

    public function index()
    {
        $titulo = "Sucursales";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("SUCURSALCONSULTA")) {
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

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Sucursal();
        $aMenu = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aSucursal) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/sistema/sucursales/' . $aSucursal[$i]->idsucursal . '">' . $aSucursal[$i]->nombre . '</a>';
            $row[] = $aSucursal[$i]->nombre;
            $row[] = $aSucursal[$i]->direccion;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aSucursal), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aSucursal), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function nuevo()
    {
        $titulo = "Nueva Sucursal";
        if (Usuario::autenticado() == true){
            if (!Patente::autorizarOperacion("SUCURSALALTA")) {
                $codigo = "SUCURSALALTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('sucursal.sucursal-nuevo', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    
}
}

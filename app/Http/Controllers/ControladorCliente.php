<?php 

 namespace App\Http\Controllers;

use App\Entidades\Cliente as EntidadesCliente;
use App\Entidades\Sistema\Menu; //include_once "app/Entidades/Sistema/Menu.php";
use App\Entidades\Sistema\Cliente; 
use App\Entidades\Sistema\MenuArea;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

class ControladorCliente extends Controller
{
    public function index()
    {
        $titulo = "Listado clientes";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                $codigo = "MENUCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('cliente.cliente-listar', compact('titulo')); //crear carpeta
            }
        } else {
            return redirect('admin/login');
        }
    }

    
 
 

     public function nuevo()
    {
        $titulo = "Nuevo cliente";

        return view('cliente.cliente-nuevo', compact('titulo') );

    }

    
  

    public function guardar(Request $request) {
    try {
        //Define la entidad servicio
        $titulo = "Modificar Cliente";
        $entidad = new Cliente();
        $entidad->cargarDesdeRequest($request);

        //validaciones
        if ($entidad->nombre == "") {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = "Complete todos los datos";
        } else {
            if ($_POST["id"] > 0) {
                //Es actualizacion
                $entidad->guardar();

                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = OKINSERT;
            } else {
                //Es nuevo
                $entidad->insertar();

                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = OKINSERT;
            }
            
            $_POST["id"] = $entidad->idcliente;
            return view('sistema.cliente-listar', compact('titulo', 'msg'));
        }
    } catch (Exception $e) {
        $msg["ESTADO"] = MSG_ERROR;
        $msg["MSG"] = ERRORINSERT;
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Cliente();
        $aCliente = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aClientes) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/sistema/clientes/' . $aClientes[$i]->idcliente . '">' . $aClientes[$i]->nombre . '</a>';
            $row[] = $aCliente[$i]->nombre;
            $row[] = $aCliente[$i]->apellido;
            $row[] = $aCliente[$i]->telefono;
            $row[] = $aCliente[$i]->correo;
            $row[] = $aCliente[$i]->usuario;

            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aMenu), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aMenu), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }
}
 ?>
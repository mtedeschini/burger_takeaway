<?php 


namespace App\Http\Controllers;

use App\Entidades\Cliente;    
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;
use Carbon\Carbon;  



require app_path().'/start/constants.php';

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

    public function nuevo(){
        $titulo = "Nuevo cliente";
        $cliente = new Cliente();

        $entidadUsuario = new Usuario();
        $aUsuarios = $entidadUsuario->obtenerTodos(); 

        return view('cliente.cliente-nuevo', compact('cliente', 'titulo' , 'aUsuarios') ); 
    }

  

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Cliente();
        $aClientes = $entidad->obtenerFiltrado(); 

        /*$entidad = new Usuario();
        $aUsuarios = $entidad->obtenerFiltrado(); */

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aClientes) && $cont < $registros_por_pagina; $i++) {
            $row = array();


            $row[] = '<a href="/admin/cliente/' . $aClientes[$i]->idcliente . '" class="btn btn-secondary"><i class="fas fa-search"></i></a>'; 
            $row[] = $aClientes[$i]->nombre . " " .$aClientes[$i]->apellido;
            $row[] = $aClientes[$i]->telefono;
            $row[] = $aClientes[$i]->correo;
            $row[] = $aClientes[$i]->usuario;  
 
           


            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),

            "recordsTotal" => count($aClientes), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aClientes), //cantidad total de registros en la paginacion

            "recordsTotal" => count($aClientes), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aClientes), //cantidad total de registros en la paginacion

            "data" => $data,
        );
        return json_encode($json_data);
    }

        

     public function guardar(Request $request) {
    try { 
        //Define la entidad servicio
        $titulo = "Modificar cliente";

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


                $date = new Carbon;
                $fecha = $date->format('Y-m-d H:i:s'); 
                

                $usuario = new Usuario();

                $usuario->usuario = $entidad->correo;
                $usuario->activo = 1;
                $usuario->nombre = $entidad->nombre;
                $usuario->apellido = $entidad->apellido;
                $usuario->mail = $entidad->correo;
                $usuario->areapredeterminada = 1;  
                $usuario->clave = "";
                $usuario->create_at = $fecha; 
               


                $idusuario = $usuario->insertar();

 

               

                $entidad->fk_idusuario = $idusuario->idusuario;
                //Es nuevo
                $entidad->insertar();

                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = OKINSERT;
            }
            
            $_POST["id"] = $entidad->idcliente;
            return view('cliente.cliente-listar', compact('titulo', 'msg'));
        }
    } catch (Exception $e) {
        $msg["ESTADO"] = MSG_ERROR;
        $msg["MSG"] = ERRORINSERT;
    }

    $id = $entidad->idcliente;
        $cliente= new Cliente(); 
        $cliente->obtenerPorId($id);

        return view('cliente.cliente-nuevo', compact('msg', 'cliente', 'titulo')) . '?id=' . $cliente->idcliente; 
}


        public function eliminar(Request $request)
    {
        $id = $request->input('id'); 

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("MENUELIMINAR")) {

          
                $entidad = new Cliente();
                $entidad->cargarDesdeRequest($request);
                $entidad->eliminar();

                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            } else {
                $codigo = "ELIMINARPROFESIONAL";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/clientes');   
        }
    }


    // va por id a la pantalle admin/cliente/nuevo
    public function editar($id)
    {
        $titulo = "Modificar Cliente";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MENUMODIFICACION")) {
                $codigo = "MENUMODIFICACION";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $cliente = new Cliente();
                $cliente->obtenerPorId($id);

                $entidadUsuario = new Usuario();
                $aUsuarios = $entidadUsuario->obtenerTodos();


                return view('cliente.cliente-nuevo', compact('cliente', 'aUsuarios', 'titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }




}




?>
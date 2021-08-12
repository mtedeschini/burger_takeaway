<?php 



namespace App\Http\Controllers;

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

        $entidad = new Cliente();
        $array_menu = $entidad->obtenerMenuPadre();

        return view('cliente.cliente-nuevo', compact('titulo', 'array_menu'));

    }

    
  
}

 ?>
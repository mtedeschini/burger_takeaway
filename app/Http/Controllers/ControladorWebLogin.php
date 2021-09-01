<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use Session;
class ControladorWebLogin extends Controller
{
    public function index()
    {
      $sucursal = new Sucursal();
      $aSucursales = $sucursal->obtenerTodos();

      return view('web.login', compact('aSucursales'));
    }

    public function ingresar(Request $request){
        $correo = $request->input("txtUsuario");
        $clave = $request->input("txtClave");

        $cliente = new Cliente;
        if($cliente->obtenerPorCorreo($correo)){
            if($cliente->verificarClave($clave, $cliente->clave)){
                //Ingresa a la web
                Session::put("cliente_id", "$cliente->idcliente");
                return redirect("/takeaway");

            } else {
                $msg = "Credenciales incorrectas";
                return view("web.login", compact('$msg'));
            }
        } else {
            $msg = "Credenciales incorrectas";
            return view("web.login", compact('$msg'));
        }


    }
}

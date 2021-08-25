<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
class ControladorWebTakeaway extends Controller
{

    public function index()
    {
        return view('web.takeaway');
    }

    public function obtenerTodos(){ 
        $sql = "SELECT
                    idproducto,
                    nombre,
                    precio,
                    descripcion,
                    imagen             
                FROM productos";
        $lstRetorno = DB::select($sql);

        $aResultado = array();
        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $entidadAux = new Producto();
                $entidadAux->idproducto = $fila["idproducto"];
                $entidadAux->nombre = $fila["nombre"];
                $entidadAux->precio = $fila["precio"];
                $entidadAux->descripcion = $fila["descripcion"];
                $entidadAux->imagen = $fila["imagen"];
                $aResultado[] = $entidadAux;
            }
        }
        $mysqli->close(); //Cierro conexión con la BBDD
        return $aResultado;
    }
}

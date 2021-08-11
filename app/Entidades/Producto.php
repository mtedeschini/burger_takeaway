<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false;

    protected $fillable = [
        'idproducto', 'nombre', 'precio', 'descripcion'
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                    idproducto,
                    nombre,
                    precio,
                    descripcion
                FROM productos ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
}

?>
<?php

namespace App\Entidades;
use DB;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model{
    protected $table = 'sucursales';
    public $timestamps = false;
    protected $fillable = [
        'idsucursal','direccion','nombre'
    ];
    protected $hidden = [

    ];

    public function obtenerTodos(){
        $sql = "SELECT
                    idsucursal,
                    direccion,
                    nombre
                FROM sucursales ORDER BY idsucursal";
        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
}

?>
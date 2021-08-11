<?php

namespace App\Entidades;
use DB;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{
    protected $table = 'clientes';
    public $timestamps = false;

    protected $fillable = [
        'idcliente', 'nombre', 'apellido', 'telefono', 'correo', 'fk_idusuario'
    ];

    protected $hidden = [

    ];


    public function obtenerTodos()
    {
        $sql = "SELECT
                    idcliente,
                    nombre,
                    apellido,
                    telefono,
                    correo,
                    fk_idusuario
                FROM clientes ORDER BY idcliente";

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
}

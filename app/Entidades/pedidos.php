<?php

namespace App\Entidades;
use DB;
use Illuminate\Database\Eloquent\Model;

class Pedudidos extends Model{
    protected $table = 'pedidos';
    public $timestamps = false;

    protected $fillable = [
        'idpedido', 'total', 'fk_idsucursal', 'fk_idcliente', 'fk_idestadopago', 'fecha'
    ];

    protected $hidden = [

    ];


    public function obtenerTodos()
    {
        $sql = "SELECT
                  idpedido,
                  total,
                  fk_idsucursal,
                  fk_idcliente,
                  fk_idestadopago,
                  fecha
                FROM pedidos ORDER BY idpedido";


        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
}

?>
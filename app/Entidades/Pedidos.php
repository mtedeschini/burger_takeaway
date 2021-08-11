<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    public $timestamps = false;

    protected $fillable = [
        'idpedido', 'fk_idsucursal', 'fk_idcliente','fk_idestado', 'fecha', 'total'
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                    idpedido,
                    fk_idsucursal,
                    fk_idcliente,
                    fk_idestado,
                    fecha,
                    total
                FROM pedidos ORDER BY idpedido";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
}
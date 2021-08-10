<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido_detalles extends Model
{
    protected $table = 'pedido_detalles';
    public $timestamps = false;

    protected $fillable = [
        'iddetalle', 'fk_idpedido', 'fk_idproducto', 'precio_unitario', 'cantidad', 'subtotal',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  iddetalle,
                  fk_idpedido,
                  fk_idproducto,
                  precio_unitario,
                  cantidad,
                  subtotal
                FROM pedido_detalles ORDER BY iddetalle";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
}
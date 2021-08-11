<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido_detalle extends Model
{
    protected $table = 'pedido_detalles';
    public $timestamps = false;

    protected $fillable = [
        'iddetalle', 'fk_idpedido', 'fk_idproducto', 'precio_unitario', 'cantidad', 'subtotal'
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

    public function obtenerPorId($iddetalle)
    {
        $sql = "SELECT
                iddetalle,
                fk_idpedido,
                fk_idproducto,
                precio_unitario,
                cantidad,
                subtotal
                FROM pedido_detalles WHERE iddetalle = $iddetalle";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->iddetalle = $lstRetorno[0]->iddetalle;
            $this->fk_idpedido = $lstRetorno[0]->fk_idpedido;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->precio_unitario = $lstRetorno[0]->precio_unitario;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->subtotal = $lstRetorno[0]->subtotal;
            return $this;
        }
        return null;
    }

























}
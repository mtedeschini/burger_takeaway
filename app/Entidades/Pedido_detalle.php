<?php

namespace App\Entidades;

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

    
    public function obtenerPorPedido($idPedido)
    {
        $sql = "SELECT
            A.iddetalle,
            A.fk_idpedido,
            B.nombre AS producto,
            A.precio_unitario,
            A.cantidad,
            A.subtotal
            FROM pedido_detalles A
            INNER JOIN productos B ON A.fk_idproducto = B.idproducto
            WHERE fk_idpedido = $idPedido
            ORDER BY producto ASC";
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
    public function guardar() {
        $sql = "UPDATE pedido_detalles SET
            iddetalle='$this->iddetalle',
            fk_idpedido='$this->fk_idpedido',
            fk_idproducto='$this->fk_idproducto',
            precio_unitario= $this->precio_unitario,
            cantidad= $this->cantidad,
            subtotal= $this->subtotal
            WHERE iddetalle=?";
        $affected = DB::update($sql, [$this->iddetalle]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedido_detalles WHERE
            iddetalle=?";
        $affected = DB::delete($sql, [$this->iddetalle]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO pedido_detalles (
                    fk_idpedido,
                    fk_idproducto,
                    precio_unitario,
                    cantidad,
                    subtotal
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idpedido,
            $this->fk_idproducto,
            $this->precio_unitario,
            $this->cantidad,
            $this->subtotal
        ]);
        return $this->iddetalle = DB::getPdo()->lastInsertId();
    }


























}
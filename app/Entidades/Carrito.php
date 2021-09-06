<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{

    protected $table = 'carritos';
    public $timestamps = false;

    protected $fillable = [
        'idcarrito', 'fk_idproducto', 'fk_idcliente', 'fk_idsucursal', 'comentarios'
    ];

    protected $hidden = [
        
    ];

    public function insertar()
    {
        $sql = "INSERT INTO carritos (
                fk_idproducto,
                cantidad,
                fk_idcliente,
                comentarios
            ) VALUES (?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idproducto,
            $this->cantidad,
            $this->fk_idcliente,
            $this->comentarios
        ]);
        return $this->idcarrito = DB::getPdo()->lastInsertId();
    }

    public function obtenerPorCliente($idCliente)
    {
        $sql = "SELECT
            A.idcarrito,
            A.fk_idproducto,
            A.fk_idcliente,
            A.cantidad AS cantidad,
            A.comentarios,
            B.nombre AS producto,
            B.precio AS precio
            FROM carritos A
            INNER JOIN productos B ON A.fk_idproducto = B.idproducto
            WHERE fk_idcliente = $idCliente
            ORDER BY idcarrito ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function eliminar()
    {
        $sql = "DELETE FROM carritos
            WHERE idcarrito=?";
        $affected = DB::delete($sql, [$this->idcarrito]);
    }

    public function vaciarCarrito($idCliente)
    {
        $sql = "DELETE FROM carritos
            WHERE fk_idcliente=$idCliente";
        $affected = DB::delete($sql, [$this->fk_idcliente]);
    }

    public function eliminarProducto($idCliente)
    {
        $sql = "DELETE FROM carritos
            WHERE fk_idcliente=$idCliente AND fk_idproducto=?";
        $affected = DB::delete($sql, [$this->fk_idproducto]);
    }

}

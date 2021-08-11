<?php

namespace App\Entidades;
use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model{
    protected $table = 'pedidos';
    public $timestamps = false;

    protected $fillable = [
        'idpedido', 'total', 'fk_idsucursal', 'fk_idcliente', 'fk_idestado', 'fk_idestadopago', 'fecha'
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
                  fk_idestado,
                  fk_idestadopago,
                  fecha
                FROM pedidos ORDER BY idpedido";


        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
}

public function obtenerPorId($idmenu)
{
    $sql = "SELECT
                  idpedido,
                  total,
                  fk_idsucursal,
                  fk_idcliente,
                  fk_idestado,
                  fk_idestadopago,
                  fecha
            url,
            css
            FROM pedidos WHERE idpedido = $idpedido";
    $lstRetorno = DB::select($sql);

    if (count($lstRetorno) > 0) {
        $this->idpedido = $lstRetorno[0]->idpedido;
        $this->total = $lstRetorno[0]->total;
        $this->fk_idsucursal = $lstRetorno[0]->fk_idsucursal;
        $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
        $this->fk_idestado = $lstRetorno[0]->fk_idestado;
        $this->fk_idestadopago = $lstRetorno[0]->fk_idestadopago;
        $this->fecha = $lstRetorno[0]->fecha;
        return $this;
    }
    return null;
}

public function guardar() {
    $sql = "UPDATE pedidos SET
        idpedido='$this->idpedido',
        total='$this->total',
        fk_idsucursal=$this->fk_idsucursal,
        fk_idcliente='$this->fk_idcliente',
        fk_idestado='$this->fk_idestado',
        fk_idestadopago='$this->fk_idestadopago',
        fecha='$this->fecha'
        WHERE idpedido=?";
    $affected = DB::update($sql, [$this->idpedido]);
}

public function eliminar()
{
    $sql = "DELETE FROM pedidos WHERE
        idpedido=?";
    $affected = DB::delete($sql, [$this->idpedido]);
}

public function insertar()
{
    $sql = "INSERT INTO pedidos (
            idpedido,
            total,
            fk_idsucursal,
            fk_idcliente,
            fk_idestado,
            fk_idestadopago,
            fecha

        ) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $result = DB::insert($sql, [
        $this->idpedido,
        $this->total,
        $this->fk_idsucursal,
        $this->fk_idcliente,
        $this->fk_idestado,
        $this->fk_idestadopago,
        $this->fecha

    ]);
    return $this->idpedido = DB::getPdo()->lastInsertId();
}

?>
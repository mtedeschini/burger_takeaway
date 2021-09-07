<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    public $timestamps = false;

    protected $fillable = [
        'idpedido', 'total', 'fk_idsucursal', 'fk_idcliente', 'fk_idestado', 'fk_idestadopago', 'fecha', 'comentarios',
    ];

    protected $hidden = [];

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idpedido',
            1 => 'A.total',
            2 => 'B.nombre',
            3 => 'C.nombre',
            4 => 'D.nombre',
            5 => 'E.nombre',
            6 => 'A.fecha',
            7 => 'A.comentarios',
        );
        $sql = "SELECT DISTINCT
                    A.idpedido,
                    A.total,
                    B.nombre as sucursal,
                    CONCAT(C.apellido,', ',C.nombre) AS cliente,
                    D.nombre as estado,
                    E.nombre as estado_pago,
                    A.fecha,
                    A.comentarios
                    FROM pedidos A
                    LEFT JOIN sucursales B ON A.fk_idsucursal = B.idsucursal
                    LEFT JOIN clientes C ON A.fk_idcliente = C.idcliente
                    LEFT JOIN estados D ON A.fk_idestado = D.idestado
                    LEFT JOIN estado_pagos E ON A.fk_idestadopago = E.idestadopago
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.idpedido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR C.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR D.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR E.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.comentarios LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.fecha LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  idpedido,
                  total,
                  fk_idsucursal,
                  fk_idcliente,
                  fk_idestado,
                  fk_idestadopago,
                  fecha,
                  comentarios
                FROM pedidos ORDER BY idpedido;";

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerPorId($idpedido)
    {
        $sql = "SELECT
                    idpedido,
                    total,
                    fk_idsucursal,
                    fk_idcliente,
                    fk_idestado,
                    fk_idestadopago,
                    fecha,
                    comentarios
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
            $this->comentarios = $lstRetorno[0]->comentarios;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE pedidos SET
                    idpedido=$this->idpedido,
                    total=$this->total,
                    fk_idsucursal=$this->fk_idsucursal,
                    fk_idcliente=$this->fk_idcliente,
                    fk_idestado=$this->fk_idestado,
                    fk_idestadopago=$this->fk_idestadopago,
                    fecha='$this->fecha',
                    comentarios='$this->comentarios'
            WHERE idpedido=?;";
        $affected = DB::update($sql, [$this->idpedido]);
    }

    public function aprobarMercadoPago($idPedido)
    {
        $sql = "UPDATE pedidos SET
                    fk_idestadopago=1
                WHERE idpedido=?;";
        $affected = DB::update($sql, [$idPedido]);
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
                total,
                fk_idsucursal,
                fk_idcliente,
                fk_idestado,
                fk_idestadopago,
                fecha,
                comentarios

            ) VALUES (?, ?, ?, ?, ?, ?,?);";
        $result = DB::insert($sql, [
            $this->total,
            $this->fk_idsucursal,
            $this->fk_idcliente,
            $this->fk_idestado,
            $this->fk_idestadopago,
            $this->fecha,
            $this->comentarios,

        ]);
        return $this->idpedido = DB::getPdo()->lastInsertId();
    }

    public function cargarDesdeRequest($request)
    {
        $this->idpedido = $request->input('id') != "0" ? $request->input('id') : $this->idpedido;
        $this->total = $request->input('txtTotal');
        $this->fk_idsucursal = $request->input('txtSucursal');
        $this->fk_idcliente = $request->input('txtCliente');
        $this->fk_idestado = $request->input('txtEstadoPedido');
        $this->fk_idestadopago = $request->input('txtEstadoPago');
        $this->fecha = $request->input('txtAnio') . ":" . $request->input('txtMes') . ":" . $request->input('txtDia');
        $this->comentarios = $request->input('txtComentarios');
    }
}

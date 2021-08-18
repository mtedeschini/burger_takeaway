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

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'nombre',
            1 => 'nombre',
            2 => 'url',
            3 => 'activo',
        );
        $sql = "SELECT DISTINCT
                    A.idpedido,
                    A.total,
                    B.idsucursal as sucursal,
                    C.idcliente as cliente,
                    D.idestado as estado,
                    E.idestadopago,
                    A.fecha
                    FROM pedidos A
                    LEFT JOIN sucursales B ON A.fk_idsucursal = B.idsucursal
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.idpedido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR C.idcliente LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR D.idestado LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.url LIKE '%" . $request['search']['value'] . "%' )";
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
                  fecha
                FROM pedidos ORDER BY idpedido";


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
                    fecha
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
            idpedido=$this->idpedido,
            total=$this->total,
            fk_idsucursal=$this->fk_idsucursal,
            fk_idcliente=$this->fk_idcliente,
            fk_idestado=$this->fk_idestado,
            fk_idestadopago=$this->fk_idestadopago,
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
                total,
                fk_idsucursal,
                fk_idcliente,
                fk_idestado,
                fk_idestadopago,
                fecha

            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->total,
            $this->fk_idsucursal,
            $this->fk_idcliente,
            $this->fk_idestado,
            $this->fk_idestadopago,
            $this->fecha

        ]);
        return $this->idpedido = DB::getPdo()->lastInsertId();
    }
}
?>
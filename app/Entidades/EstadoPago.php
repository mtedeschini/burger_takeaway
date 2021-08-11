<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class EstadoPago extends Model
{
        protected $table = 'estado_pagos';
        public $timestamps = false;
    
        protected $fillable = [
            'idestadopago', 'nombre'
        ];
    
        protected $hidden = [
    
        ];


    public function obtenerTodos()
    {
        $sql = "SELECT
                  idestadopago,
                  nombre
                FROM estado_pagos ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function guardar() {
        $sql = "UPDATE estado_pagos SET
            idestadopago=$this->idestadopago,
            nombre='$this->nombre'
            WHERE idestadopago=?";
        $affected = DB::update($sql, [$this->idestadopago]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM estado_pagos WHERE
            idestadopago=?";
        $affected = DB::delete($sql, [$this->idestadopago]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO estado_pagos (
                idestadopago,
                nombre
            ) VALUES (?, ?);";
        $result = DB::insert($sql, [
            $this->idestadopago,
            $this->nombre
        ]);
        return $this->idestadopago = DB::getPdo()->lastInsertId();
    }

    public function obtenerPorId($idestadopago)
    {
        $sql = "SELECT
                idestadopago,
                nombre
                FROM estado_pagos WHERE idestadopago = $idestadopago";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idestadopago = $lstRetorno[0]->idestadopago;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }
}


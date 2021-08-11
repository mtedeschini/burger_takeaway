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

    
}
<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    public $timestamps = false;

    protected $fillable = [
        'idpago', 'nombre', 'activo'
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                    idpago,
                    nombre,
                    activo
                FROM pagos ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


}
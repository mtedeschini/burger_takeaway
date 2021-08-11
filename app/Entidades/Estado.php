<?php
namespace App\Entidades;

use DB;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{ 
    protected $table = 'estado';
    public $timestamps = false;

    protected $fillable = [
     'idestado' , 'nombre'
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                    idestado,
                    nombre
                FROM estado ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

}
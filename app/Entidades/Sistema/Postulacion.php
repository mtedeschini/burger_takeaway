<?php 

namespace App\Entidades;

use DB;
        use Illuminate\database\Eloquent\Model;

Class Postulacion extends model{
    protected $table = 'postulaciones';
    public $timestamps = false;

    protected $fillable = [
        'idpostulacion', 'nombre', 'apellido', 'localidad', 'documento', 'correo', 'telefono', 'archivo_cv'
    ];
    protected $hidden = [

    ];
    public function obtenerTodos()
    {
        $sql 
        
    }
}



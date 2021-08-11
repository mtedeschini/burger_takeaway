<?php 

namespace App\Entidades;

use Illuminate\database\Eloquent\Model;
use DB;
Class Postulacion extends model{
    protected $table = 'postulaciones';
    public $timestamps = false;

    protected $fillable = [
        'idpostulacion',
        'nombre',
        'apellido', 
        'localidad',
        'documento',
        'correo',
        'telefono',
        'archivo_cv'
    ];
    protected $hidden = [

    ];
    public function obtenerTodos()
    {
        $sql = "SELECT
            idpostulacion,
            nombre,
            apellido,
            localidad,
            documento,
            correo,
            telefono,
            archivo_cv
        FROM postulaciones ORDER BY idpostulacion";
 
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


public function obtenerPorId($idpostulacion)
{
    $sql = "SELECT
            idpostulacion,
            nombre,
            apellido,
            localidad,
            documento,
            correo,
            telefono,
            archivo_cv
            FROM postulaciones WHERE idpostulacion = $idpostulacion";
    $lstRetorno = DB::select($sql);

    if (count($lstRetorno) > 0) {
        $this->idpostulacion = $lstRetorno[0]->idpostulacion;
        $this->nombre = $lstRetorno[0]->nombre;
        $this->apellido = $lstRetorno[0]->apellido;
        $this->localidad = $lstRetorno[0]->localidad;
        $this->documento = $lstRetorno[0]->documento;
        $this->correo = $lstRetorno[0]->correo;
        $this->telefono = $lstRetorno[0]->telefono;
        $this->archivo_cv = $lstRetorno[0]->archivo_cv;
        return $this;
    }
    return null;
}

public function guardar() {
    $sql = "UPDATE postulaciones SET
        nombre='$this->nombre',
        apellido='$this->apellido',
        localidad=$this->localidad,
        documento='$this->documento',
        correo='$this->correo',
        telefono='$this->telefono'
        WHERE idpostulacion=?";
    $affected = DB::update($sql, [$this->idpostulacion]);
}

public function eliminar()
{
    $sql = "DELETE FROM postulaciones WHERE
        idpostulacion=?";
    $affected = DB::delete($sql, [$this->idpostulacion]);
}

public function insertar()
{
    $sql = "INSERT INTO postulaciones (
           idpostulacion,
            nombre,
            apellido,
            localidad,
            documento,
            correo,
            telefono,
            archivo_cv
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";


    $result = DB::insert($sql, [
        $this->nombre,
        $this->apellido,
        $this->localidad,
        $this->documento,
        $this->correo,
        $this->telefono,
        $this->archivo_cv,
    ]);
    return $this->idpostulacion = DB::getPdo()->lastInsertId();
}



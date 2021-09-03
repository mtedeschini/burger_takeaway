<?php

namespace App\Entidades;

use DB;
use Illuminate\database\Eloquent\Model;

class Postulacion extends model
{
    protected $table = 'postulaciones';
    public $timestamps = false;

    protected $fillable = [
        'idpostulacion', 'nombre', 'apellido', 'localidad', 'documento', 'correo', 'telefono', 'archivo_cv',
    ];
    protected $hidden = [

    ];

    public function cargarDesdeRequest($request) {
        $this->idpostulacion = $request->input('id') != "0" ? $request->input('id') : $this->idpostulacion;
        $this->nombre = $request->input('txtNombre');
        $this->apellido = $request->input('txtApellido');
        $this->localidad = $request->input('txtLocalidad');
        $this->documento = $request->input('txtDocumento');
        $this->correo = $request->input('txtCorreo');
        $this->telefono = $request->input('txtTelefono');
        $this->archivo_cv = $request->input('archivo_cv');
    }

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

    public function guardar()
    {
        $sql = "UPDATE postulaciones SET
        idpostulacion=$this->idpostulacion,
        nombre='$this->nombre',
        apellido='$this->apellido',
        localidad='$this->localidad',
        documento='$this->documento',
        correo='$this->correo',
        telefono='$this->telefono',
        archivo_cv='$this->archivo_cv'
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
            $this->idpostulacion,
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
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'idpostulacion',
            1 => 'nombre',
            2 => 'apellido',
            3 => 'localidad',
            4 => 'documento',
            5 => 'correo',
            6 => 'telefono',
            7 => 'archivo_cv',
       
        );
        $sql = "SELECT DISTINCT
                    idpostulacion,
                    nombre,
                    apellido,
                    localidad,
                    documento,
                    correo,
                    telefono,
                    archivo_cv
                    FROM postulaciones 
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( idpostulacion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR apellido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR localidad LIKE '%" . $request['search']['value'] . "%' "; 
            $sql .= " OR documento LIKE '%" . $request['search']['value'] . "%' "; 
            $sql .= " OR correo LIKE '%" . $request['search']['value'] . "%' "; 
            $sql .= " OR telefono LIKE '%" . $request['search']['value'] . "%' "; 
            $sql .= " OR archivo_cv LIKE '%" . $request['search']['value'] . "%' )"; 
           
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;

   }
    
    

}


?>
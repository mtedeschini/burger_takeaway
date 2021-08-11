<?php

namespace App\Entidades;
use DB;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{
    protected $table = 'clientes';
    public $timestamps = false;

    protected $fillable = [
        'idcliente', 'nombre', 'apellido', 'telefono', 'correo', 'fk_idusuario'
    ];

    protected $hidden = [

    ];


    public function obtenerTodos()
    {
        $sql = "SELECT
                    idcliente,
                    nombre,
                    apellido,
                    telefono,
                    correo,
                    fk_idusuario
                FROM clientes ORDER BY idcliente";

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerPorId($idcliente)
    {
        $sql = "SELECT
                idcliente,
                nombre,
                apellido,
                telefono,
                correo,
                fk_idusuario
                FROM clientes WHERE idcliente = $idcliente";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->correo = $lstRetorno[0]->correo;
            $this->fk_idusuario = $lstRetorno[0]->fk_idusuario;
            return $this;
        }
        return null;
    }

    public function insertar()
    {
        $sql = "INSERT INTO clientes (
                nombre,
                apellido,
                telefono,
                correo,
                fk_idusuario
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->telefono,
            $this->correo,
            $this->fk_idusuario
        ]);
        return $this->idcliente = DB::getPdo()->lastInsertId();
    }

    public function eliminar()
    {
        $sql = "DELETE FROM clientes WHERE
            idcliente=?";
        $affected = DB::delete($sql, [$this->idcliente]);
    }

    public function guardar() {
        $sql = "UPDATE clientes SET
            nombre='$this->nombre',
            apellido='$this->apellido',
            telefono=$this->telefono,
            correo='$this->correo',
            fk_idusuario=$this->fk_idusuario
            WHERE idcliente=?";
        $affected = DB::update($sql, [$this->idcliente]);
    }
}

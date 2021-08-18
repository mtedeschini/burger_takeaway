<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false;

    protected $fillable = [
        'idproducto', 'nombre', 'precio', 'descripcion'
    ];

    protected $hidden = [

    ];

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.nombre',
            1 => 'A.precio',
            2 => 'A.descripcion'
        );
        $sql = "SELECT DISTINCT
                    A.idproducto,
                    A.nombre,
                    A.precio,
                    A.descripcion
                    FROM productos A
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.precio LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.descripcion LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                    idproducto,
                    nombre,
                    precio,
                    descripcion
                FROM productos ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    
    public function obtenerPorId($idproducto)
    {
        $sql = "SELECT
                    idproducto,
                    nombre,
                    precio,
                    descripcion                
                FROM productos WHERE idproducto = $idproducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproducto = $lstRetorno[0]->idproducto;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->precio = $lstRetorno[0]->precio;
            $this->descripcion = $lstRetorno[0]->descripcion;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE productos SET
                    nombre='$this->nombre',
                    precio=$this->precio,
                    descripcion='$this->descripcion'
                WHERE idproducto=?";
        $affected = DB::update($sql, [$this->idproducto]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM productos WHERE
            idproducto=?";
        $affected = DB::delete($sql, [$this->idproducto]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO productos (
                    nombre,
                    precio,
                    descripcion
                ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->precio,
            $this->descripcion
        ]);
        return $this->idproducto = DB::getPdo()->lastInsertId();
    }
}

?>
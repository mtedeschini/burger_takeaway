<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promos';
    public $timestamps = false;

    protected $fillable = [
        'idpromo', 'nombre', 'precio', 'descripcion', 'imagen'
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                    idproducto,
                    nombre,
                    precio,
                    descripcion,
                    imagen
                FROM productos 
                WHERE fk_idtipoproducto = 2 
                ORDER BY idproducto";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idpromo)
    {
        $sql = "SELECT
                    idpromo,
                    nombre,
                    precio,
                    descripcion,
                    imagen             
                FROM promos WHERE idpromo = $idpromo";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpromo = $lstRetorno[0]->idpromo;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->precio = $lstRetorno[0]->precio;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->imagen = $lstRetorno[0]->imagen;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE promos SET
                    nombre='$this->nombre',
                    precio=$this->precio,
                    descripcion='$this->descripcion',
                    imagen='$this->imagen'
                WHERE idpromo=?";
        $affected = DB::update($sql, [$this->idpromo]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM promos WHERE
            idpromo=?";
        $affected = DB::delete($sql, [$this->idpromo]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO promos (
                    nombre,
                    precio,
                    descripcion,
                    imagen
                ) VALUES (?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->precio,
            $this->descripcion,
            $this->imagen
        ]);
        return $this->idpromo = DB::getPdo()->lastInsertId();
    }

        //esta funcion ya la habia echo valentina pero yo no la veia cuando hice la sincronizacion y la volvi a hacer.
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'nombre',
            1 => 'precio',
            2 => 'descripcion',
       
        );
        $sql = "SELECT DISTINCT
                    idpromo,
                    nombre,
                    precio,
                    descripcion,
                    imagen
                    FROM promos 
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR precio LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR descripcion LIKE '%" . $request['search']['value'] . "%' )"; 
           
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;

   }

    public function cargarDesdeRequest($request) {
    $this->idpromo = $request->input('id') != "0" ? $request->input('id') : $this->idpromo;
    $this->nombre = $request->input('txtNombre');
    $this->precio = $request->input('txtPrecio') != "" ? $request->input('txtPrecio') : 0;
    $this->descripcion = $request->input('txtDescripcion');
    }
}


?>
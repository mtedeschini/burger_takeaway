<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false;

    protected $fillable = [
        'idproducto', 'nombre', 'precio', 'descripcion', 'imagen', 'fk_idtipoproducto'
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
                WHERE fk_idtipoproducto = 1 
                ORDER BY idproducto";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
    public function obtenerTodoos()
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

    public function obtenerPromociones()
    {
        $sql = "SELECT
                    idproducto,
                    nombre,
                    precio,
                    descripcion,
                    fk_idtipoproducto,
                    imagen
                FROM productos 
                WHERE fk_idtipoproducto = 2 
                ORDER BY idproducto";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idproducto)
    {
        $sql = "SELECT
                    idproducto,
                    nombre,
                    precio,
                    descripcion,
                    imagen,
                    fk_idtipoproducto
                FROM productos WHERE idproducto = $idproducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproducto = $lstRetorno[0]->idproducto;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->precio = $lstRetorno[0]->precio;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->imagen = $lstRetorno[0]->imagen;
            $this->fk_idtipoproducto = $lstRetorno[0]->fk_idtipoproducto;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE productos SET
                    nombre='$this->nombre',
                    precio=$this->precio,
                    descripcion='$this->descripcion',
                    imagen='$this->imagen',
                    fk_idtipoproducto=$this->fk_idtipoproducto 
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
                    descripcion,
                    imagen,
                    fk_idtipoproducto
                ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->precio,
            $this->descripcion,
            $this->imagen,
            $this->fk_idtipoproducto
        ]);
        return $this->idproducto = DB::getPdo()->lastInsertId();
    }

        //esta funcion ya la habia echo valentina pero yo no la veia cuando hice la sincronizacion y la volvi a hacer.
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'nombre',
            1 => 'precio',
            2 => 'descripcion',
            3=> 'fk_idtipoproducto'
       
        );
        $sql = "SELECT DISTINCT
                    A.idproducto,
                    A.nombre,
                    A.precio,
                    A.descripcion,
                    A.imagen,
                    B.nombre as fk_idtipoproducto
                    FROM productos A 
                    LEFT JOIN tipo_productos B ON A.fk_idtipoproducto = B.idtipoproducto
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
    $this->idproducto = $request->input('id') != "0" ? $request->input('id') : $this->idproducto;
    $this->nombre = $request->input('txtNombre');
    $this->precio = $request->input('txtPrecio') != "" ? $request->input('txtPrecio') : 0;
    $this->descripcion = $request->input('txtDescripcion');
    $this->fk_idtipoproducto = $request->input('txtTipoProducto');
    }
}


?>
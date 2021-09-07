<?php

namespace App\Entidades;
use DB;
use Illuminate\Database\Eloquent\Model;

class Tipo_producto extends Model{
    protected $table = 'tipo_producto';
    public $timestamps = false;
    protected $fillable = [
        'idtipoproducto','nombre'
    ];
    protected $hidden = [

    ];


    public function cargarDesdeRequest($request) {
        $this->idtipoproducto = $request->input('id') != "0" ? $request->input('id') : $this->idtipoproducto;
        $this->nombre = $request->input('txtNombre');
        
    }


    public function obtenerTodos(){
        $sql = "SELECT
                    idtipoproducto,
                    nombre
                FROM tipo_productos ORDER BY idtipoproducto";
        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerPorId($idtipoproducto)
    {
        $sql = "SELECT
                    idtipoproducto,
                    nombre
                FROM tipo_productos WHERE idtiporproducto = $idtipoproducto";
        $lstRetorno = DB::select($sql);
        
        if (count($lstRetorno)>0){
            $this->idtipoproducto = $lstRetorno[0]->idtipoproducto;
            $this->nombre =  $lstRetorno[0]->nombre;
            return $this;
        }

        return null;
    }

    public function insertar()
    {
        $sql = "INSERT INTO idtipoproducto (
                telefono
                ) VALUES (?);";
        $result = DB::insert($sql,[$this->nombre]);
        return $this->idtipoproducto = DB::getPdo()->lastInsertId();
    }

    public function guardar()
    {
        $sql = "UPDATE tipo_productos SET
                nombre = '$this->nombre'
                WHERE idtipoproducto=?;";
        $affected = DB::update($sql,[$this->idtipoproducto]);
    }
    public function eliminar()
    {
        $sql = "DELETE FROM tipo_productos WHERE
            idtipoproducto=?";
        $affected = DB::delete($sql, [$this->idtipoproducto]);
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'nombre'

        );
        $sql = "SELECT DISTINCT
                    idtipoproducto,
                    nombre
                   
                    FROM tipo_productos";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR direccion LIKE '%" . $request['search']['value'] . "%' ";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
   
}

?>
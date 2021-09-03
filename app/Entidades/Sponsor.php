<?php

namespace App\Entidades;

use DB;
use Illuminate\database\Eloquent\Model;

class Sponsor extends Model
{
    protected $table = 'sponsors';
    public $timestamps = false;

    protected $fillable = [
        'idsponsor', 'nombre_empresa','nombre_producto', 'descripcion', 'cantidad_producto', 'email', 'telefono', 'foto_producto'
    ];
    protected $hidden = [

    ];

    public function cargarDesdeRequest($request) {
        $this->idsponsor = $request->input('id') != "0" ? $request->input('id') : $this->idsponsor;
        $this->nombre_empresa = $request->input('txtNombreEmpresa');
        $this->nombre_producto = $request->input('txtNombreProducto');
        $this->descripcion = $request->input('txtDescripcion');
        $this->cantidad_producto = $request->input('intCantidad');
        $this->foto_producto = $request->input('archivo');
        $this->email = $request->input('txtEmail');
        $this->telefono = $request->input('txtTelefono');
        
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
            idsponsor,
            nombre_empresa,
            nombre_producto,
            descripcion,
            cantidad_producto,
            telefono,
            email,
            foto_producto
        FROM sponsors ORDER BY idsponsor";

        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idsponsor)
    {
        $sql = "SELECT
            idsponsor,
            nombre_empresa,
            nombre_producto,
            descripcion,
            cantidad_producto,
            telefono,
            email,
            foto_producto
            FROM sponsors
            WHERE idsponsor = $idsponsor";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idsponsor = $lstRetorno[0]->idsponsor;
            $this->nombre_empresa = $lstRetorno[0]->nombre_empresa;
            $this->nombre_producto = $lstRetorno[0]->nombre_producto;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->cantidad_producto = $lstRetorno[0]->cantidad_producto;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->email = $lstRetorno[0]->email;
            $this->foto_producto = $lstRetorno[0]->foto_producto;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE sponsors SET
        idsponsor=$this->idsponsor,
        nombre_empresa='$this->nombre_empresa',
        nombre_producto='$this->nombre_producto',
        descripcion='$this->descripcion',
        cantidad_producto=$this->cantidad_producto,
        telefono='$this->telefono',
        email='$this->email',
        foto_producto='$this->foto_producto'
        WHERE idsponsor=?";
        $affected = DB::update($sql, [$this->idsponsor]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM sponsors WHERE
        idsponsor=?";
        $affected = DB::delete($sql, [$this->idsponsor]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO sponsors (
            
            nombre_empresa,
            nombre_producto,
            descripcion,
            cantidad_producto,
            telefono,
            email,
            foto_producto
        ) VALUES (?, ?, ?, ?, ?, ?, ?);";

        $result = DB::insert($sql, [
         
            $this->nombre_empresa,
            $this->nombre_producto,
            $this->descripcion,
            $this->cantidad_producto,
            $this->telefono,
            $this->email,
            $this->foto_producto
        ]);
        return $this->idsponsor = DB::getPdo()->lastInsertId();
    }
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(

            0 => 'idsponsor',
            1 => 'nombre_empresa',
            2 => 'nombre_producto',
            3 => 'descripcion',
            4 => 'cantidad_producto',
            5 => 'telefono',
            6 => 'email',
            7 => 'foto_producto'
       
        );
        $sql = "SELECT DISTINCT
                    idsponsor,
                    nombre_empresa,
                    nombre_producto,
                    descripcion,
                    cantidad_producto,
                    telefono,
                    email,
                    foto_producto
                    FROM sponsors 
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( idsponsor LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR nombre_empresa LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR nombre_producto LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR descripcion LIKE '%" . $request['search']['value'] . "%' "; 
            $sql .= " OR cantidad_producto LIKE '%" . $request['search']['value'] . "%' "; 
            $sql .= " OR telefono LIKE '%" . $request['search']['value'] . "%' "; 
            $sql .= " OR email LIKE '%" . $request['search']['value'] . "%' "; 
            $sql .= " OR foto_producto LIKE '%" . $request['search']['value'] . "%' )"; 
           
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;

   }
    
    

}


?>
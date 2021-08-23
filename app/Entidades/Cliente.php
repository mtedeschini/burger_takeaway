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
                    A.idcliente, 
                    A.nombre,
                    A.apellido,
                    A.telefono,
                    A.correo,
                    B.usuario
                  FROM clientes A
                LEFT JOIN sistema_usuarios B ON A.fk_idusuario = B.idusuario  
                
                ";

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerPorId($idcliente)
    {
          $sql = "SELECT
                    A.idcliente, 
                    A.nombre,
                    A.apellido,
                    A.telefono,
                    A.correo,
                    B.usuario
                FROM clientes A
                LEFT JOIN sistema_usuarios B ON A.fk_idusuario = B.idusuario  
                
                ";
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

    public function nuevo()
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

      public function insertar()
    {
        $sql = "INSERT INTO clientes (
                    nombre,
                    apellido,
                    telefono,
                    correo,
                    fk_idusuario 
                  
                ) 

                VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->telefono,
            $this->correo,
            $this->fk_idusuario,

        ]);
        return $this->idproducto = DB::getPdo()->lastInsertId();
    }

    public function guardar() {
        $sql = "UPDATE clientes SET
            nombre='$this->nombre',
            apellido='$this->apellido',
            telefono='$this->telefono',
            correo='$this->correo',
            fk_idusuario=$this->fk_idusuario
            WHERE idcliente=?";
        $affected = DB::update($sql, [$this->idcliente]);
    }


    //search
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.nombre',
            1 => 'A.apellido',
            2 => 'A.telefono',
            3 => 'A.correo',
            4 => 'A.fk_idusuario'
        );//el usuario es unico por lo tanto se debe invocar ?
        $sql = "SELECT DISTINCT
                    A.idcliente, 
                    A.nombre,
                    A.apellido,
                    A.telefono,
                    A.correo,
                    B.usuario 
                    FROM clientes A
                    LEFT JOIN sistema_usuarios B ON A.fk_idusuario = B.idusuario  
                WHERE 1=1
                "; 

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' " ;
            $sql .= " OR A.apellido LIKE '%" . $request['search']['value'] . "%' " ;
            $sql .= " OR A.telefono LIKE '%" . $request['search']['value'] . "%' " ;
            $sql .= " OR A.correo LIKE '%" . $request['search']['value'] . "%') ";
            $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];
        }

     

        $lstRetorno = DB::select($sql);

        return $lstRetorno;

   }// end obtener por filtrado

    public function cargarDesdeRequest($request) {
    $this->idcliente = $request->input('id') != "0" ? $request->input('id') : $this->idcliente;
    $this->nombre = $request->input('txtNombre');
    $this->apellido = $request->input('txtApellido');
    $this->telefono = $request->input('txtTelefono');
    $this->correo = $request->input('txtCorreo');
    $this->usuario = $request->input('txtUsuario');

    }
}

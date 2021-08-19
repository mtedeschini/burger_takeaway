<?php

namespace App\Entidades;
use DB;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model{
    protected $table = 'sucursales';
    public $timestamps = false;
    protected $fillable = [
        'idsucursal','direccion','nombre'
    ];
    protected $hidden = [

    ];


    public function cargarDesdeRequest($request) {
        $this->idsucursal = $request->input('id') != "0" ? $request->input('id') : $this->idsucursal;
        $this->direccion = $request->input('txtDireccion');
        $this->nombre = $request->input('txtNombre');
        
    }
        public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'nombre',
            1 => 'direccion',
        );
        $sql = "SELECT DISTINCT
                    nombre,
                    direccion,

                    FROM sistema_menues A
                    LEFT JOIN sistema_menues B ON A.id_padre = B.idmenu
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.url LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerTodos(){
        $sql = "SELECT
                    idsucursal,
                    direccion,
                    nombre
                FROM sucursales ORDER BY idsucursal";
        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerPorId($idsucursal)
    {
        $sql = "SELECT
                    idsucursal,
                    direccion,
                    nombre
                FROM sucursales WHERE idsucursal = $idsucursal";
        $lstRetorno = DB::select($sql);
        
        if (count($lstRetorno)>0){
            $this->idsucursal = $lstRetorno[0]->idsucursal;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->nombre =  $lstRetorno[0]->nombre;
            return $this;
        }

        return null;
    }

    public function insertar()
    {
        $sql = "INSERT INTO sucursales (
                direccion,
                nombre
                ) VALUES (?, ?);";
        $result = DB::insert($sql,[$this->direccion, $this->nombre]);
        return $this->idsucursal = DB::getPdo()->lastInsertId();
    }

    public function guardar()
    {
        $sql = "UPDATE sucursales SET
                direccion = '$this->direccion',
                nombre = '$this->nombre'
                WHERE idsucursal=?;";
        $affected = DB::update($sql,[$this->idsucursal]);
    }



    
}

?>
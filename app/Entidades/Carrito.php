<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{

    protected $table = 'carritos';
    public $timestamps = false;
  
    protected $fillable = [
        'idcarrito', 'fk_idproducto', 'fk_idcliente'
    ];
  
    protected $hidden = [
  
    ];
  
    public function insertar()
    {
        $sql = "INSERT INTO carritos (
                idcarrito,
                fk_idproducto,
                cantidad,
                fk_idcliente
  
            ) VALUES (?, ?, ?, ?);";
            $result = DB::insert($sql, [
            $this->idcarrito,
            $this->cantidad,
            $this->fk_idproducto,
            $this->fk_idcliente
  
        ]);
        return $this->idcarrito = DB::getPdo()->lastInsertId();
    }

    public function obtenerPorUsuario() {

    }

   public function eliminar()
   {
       $sql = "DELETE FROM carritos 
            WHERE idcarrito=?";
        $affected = DB::delete($sql, [$this->idcarrito]);
   }

   

}
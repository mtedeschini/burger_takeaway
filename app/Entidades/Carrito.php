<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\sql_injection_subst;

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

    public function obtenerPorUsuario() 
    {
        $sql ="SELECT
            idcarrito,
            fk_idproducto,
            fk_idcliente
            FROM carritos
            ORDER BY idcarrito"
        ;

        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcarrito = $lstRetorno[0]->idcarrito;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;

            return $this;
        }
        return null;
    }

   public function eliminar()
   {
       $sql = "DELETE FROM carritos 
            WHERE idcarrito=?";
        $affected = DB::delete($sql, [$this->idcarrito]);
   }

   

}
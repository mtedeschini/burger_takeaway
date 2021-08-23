<?php 

	namespace App\Entidades;

	use DB;
	use Illuminate\Database\Elquent\Model;


    
	class Pago extends Model
	{
		
		protected $table="pagos";
		public $timestamps = false;	


		protected $filalable=[ "idpago", "nombre", "activo"];

		protected $hidden = [

		] ; 
		
		public function obtenerTodos()
    {
        $sql = "SELECT
                 idpago,
                 nombre,
                 activo
                FROM pagos A ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
	

	public function insertar(){
       
        //Arma la query
        $sql = "INSERT INTO pagos (
                    idpago,
                 	nombre,
                 	activo
                ) VALUES (
                    '$this->idpago', 
                    '$this->nombre',
                    '$this->activo' 
                     
                );";
        //Ejecuta la query
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
}

 ?>
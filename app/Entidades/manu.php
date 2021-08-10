<?php 

	namespace App\Entidades;

	use DB;
	use Illuminate\Database\Elquent\Model;

	/**
	 * 
	 */
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
	}
 ?>
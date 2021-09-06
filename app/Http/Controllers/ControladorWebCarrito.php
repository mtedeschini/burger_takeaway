<?php

namespace App\Http\Controllers;

use App\Entidades\Carrito;
use App\Entidades\Sucursal;
use App\Entidades\Pedido;
use App\Entidades\Pedido_detalle;
use Illuminate\Http\Request;
use Carbon\Carbon;


use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;
use Session;

class ControladorWebCarrito extends Controller
{
    public function index()
    {
        if(Session::get('cliente_id') != ""){
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente(Session::get('cliente_id'));

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $productosCarrito = 0;
        foreach ($aCarritos as $item){
            $productosCarrito += $item->cantidad;
        }

        return view('web.carrito', compact('aCarritos', 'aSucursales', 'productosCarrito'));
        } else {
            return redirect("/login");
        }
    }

    public function finalizarPedido(Request $request){
        $entidadPedido = new Pedido();
        $entidadCarrito = new Carrito();

        if ($request->has('finalizar')){

            $idSucursal = $request->input('txtSucursal'); // IDSUCURSAL
            $comentarios = $request->input('txtComentarios'); 
            $abona = $request->input('txtAbona'); 

            $aCarritos = $entidadCarrito->obtenerPorCliente(Session::get('cliente_id'));

            $total = 0;
            foreach ($aCarritos as $item){
                $total = $total + $item->cantidad * $item->precio;
            }
            
            if ($abona == "local"){
                
                $entidadPedido->fk_idcliente = Session::get('cliente_id');
                $entidadPedido->total = $total; 
                $entidadPedido->fk_idsucursal = $idSucursal;
                $entidadPedido->fk_idestado = '1';
                $entidadPedido->fk_idestadopago = '3';
                $entidadPedido->comentarios = $comentarios;
                $entidadPedido->fecha = Carbon::now();
                $idPedido = $entidadPedido->insertar();
               
            }

            if ($abona == "mp"){
                
                SDK::setClientId(config("payment-methods.mercadopago.client"));
                SDK::setClientSecret(config("payment-methods.mercadopago.secret"));
                SDK::setAccessToken(config('services.mercadopago.token')); //Es el token de la cuenta de MP donde se deposita el dinero
                //Obtener de la BBDD el carrito actual del usuario
                foreach ($item as $product){
                    $item = new Item();
                    $item->id = "1234";
                    $item->title = "Burger SRL";
                    $item->category_id = "products";
                    $item->quantity = 1;
                    $item->unit_price = $total;
                    $item->currency_id = "ARS";
                }
        
                $preference = new Preference();
                $preference->items = array($item);
        
                //Datos del comprador
                $payer = new Payer();
                $payer->name = $cliente->nombre;
                $payer->surname = $cliente->apellido;
                $payer->email = $cliente->email;
                $payer->date_created = date('Y-m-d H:m:s');
                $payer->identification = array(
                    "type" => "CUIT",
                    "number" => $cliente->cuit
                );
                $preference->payer = $payer;
        
                //URL de configuración para indicarle a MP
                $preference->back_urls = [
                    "success" => "http://127.0.0.1:8000/mercado-pago/aprobado/" . $pedido->idpedido,
                    "pending" => "http://127.0.0.1:8000/mercado-pago/pendiente/" . $pedido->idpedido,
                    "failure" => "http://127.0.0.1:8000/mercado-pago/error/" . $pedido->idpedido,
                ];
        
                //Preparar la transaccion con mercadopago
                $preference->payment_methods = array("installments" => 6);
                $preference->auto_return = "all";
                $preference->notification_url = '';
                $preference->save(); //Ejecuta la transacción

                $entidadPedido->fk_idcliente = Session::get('cliente_id');
                $entidadPedido->total = $total; 
                $entidadPedido->fk_idsucursal = $idSucursal;
                $entidadPedido->fk_idestado = '1';
                $entidadPedido->fk_idestadopago = '1';
                $entidadPedido->comentarios = $comentarios;
                $entidadPedido->fecha = Carbon::now();
                $idPedido = $entidadPedido->insertar();
                
            }

            foreach ($aCarritos as $item){  //Hacer foreach que recorra los productos del carrito e insertarlo en el pedido_detallle

                $pedidoDetalle = new Pedido_detalle();
                $pedidoDetalle->fk_idpedido = $idPedido;
                $pedidoDetalle->fk_idproducto = $item->fk_idproducto;
                $pedidoDetalle->precio_unitario = $item->precio;
                $pedidoDetalle->cantidad = $item->cantidad;
                $pedidoDetalle->subtotal = ($item->cantidad * $item->precio);           
                $pedidoDetalle->insertar();

                }
                
                $entidadCarrito->vaciarCarrito($entidadPedido->fk_idcliente);//Vaciar la tabla carrito para el cliente logueado
                return redirect('/recibido');
        }

        if ($request->has('vaciar')){
            $entidadCarrito->fk_idcliente = Session::get('cliente_id');
            $entidadCarrito->vaciarCarrito($entidadCarrito->fk_idcliente);//Vaciar la tabla carrito para el cliente logueado
            return redirect('/carrito');
        }
    }
        
    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar Carrito";
            $entidadCarrito = new Carrito();
            $entidadCarrito->cargarDesdeRequest($request);

            //validaciones
            if ($entidadCarrito->fk_idproducto == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $entidadCarrito->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //es nuevo
                    $entidadCarrito->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                }


                $_POST["id"] = $entidadCarrito->idcarrito;
                return view('carrito.carrito-listar', compact('titulo', 'msg',));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidadCarrito->idcarrito;
        $carrito = new Carrito();

        $carrito->obtenerPorId($id);

        return view('carrito.carrito-nuevo', compact('msg', 'carrito', 'titulo')) . '?id=' . $carrito->idcarrito;
    }
}

<?php

namespace App\Http\Controllers;

use App\Entidades\Carrito;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

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
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorUsuario(Session::get('cliente_id'));

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view('web.carrito', compact('aCarritos', 'aSucursales'));
    }


    public function finalizarPedido(Request $request)
    {
        SDK::setClientId(config("payment-methods.mercadopago.client"));
        SDK::setClientSecret(config("payment-methods.mercadopago.secret"));
        SDK::setAccessToken($access_token); //Es el token de la cuenta de MP donde se deposita el dinero

        //Obtener de la BBDD el carrito actual del usuario
        $item = new Item();
        $item->id = "1234";
        $item->title = "Burger SRL";
        $item->category_id = "products";
        $item->quantity = 1;
        $item->unit_price = $precioTotalPedido;
        $item->currency_id = "ARS";

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

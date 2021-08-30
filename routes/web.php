<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(array('domain' => '127.0.0.1'), function () {

    Route::get('/', 'ControladorWebHome@index');
    Route::get('/nosotros', 'ControladorWebNosotros@index');
    Route::get('/takeaway', 'ControladorWebTakeaway@index');
    Route::get('/promociones', 'ControladorWebpromociones@index');
    Route::get('/contacto', 'ControladorWebContacto@index');
    Route::get('/mi-cuenta', 'ControladorLogin@index');
    Route::get('/carrito', 'ControladorWebCarrito@index');
    Route::post('/admin/patente/nuevo', 'ControladorPatente@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR CLIENTES*/
    /* --------------------------------------------- */
    Route::get('/admin/clientes', 'ControladorCliente@index');  
    Route::get('/admin/cliente/nuevo', 'ControladorCliente@nuevo');
    Route::post('/admin/cliente/nuevo', 'ControladorCliente@guardar'); 
    Route::get('/admin/cliente/cargarGrilla', 'ControladorCliente@cargarGrilla')->name('cliente.cargarGrilla'); 
    Route::get('/admin/cliente/eliminar', 'ControladorCliente@eliminar');   
    Route::get('/admin/cliente/{id}', 'ControladorCliente@editar');
    Route::post('/admin/cliente/{id}', 'ControladorCliente@guardar');  

    /* --------------------------------------------- */
    /* CONTROLADOR PRODUCTOS                          */
    /* --------------------------------------------- */
    Route::get('/admin/productos', 'ControladorProducto@index');
    Route::get('/admin/producto/nuevo', 'ControladorProducto@nuevo');
    Route::post('/admin/producto/nuevo', 'ControladorProducto@guardar');
    Route::get('/admin/producto/cargarGrilla', 'ControladorProducto@cargarGrilla')->name('producto.cargarGrilla');
    Route::get('/admin/producto/eliminar', 'ControladorProducto@eliminar');
    Route::get('/admin/producto/{id}', 'ControladorProducto@editar');
    Route::post('/admin/producto/{id}', 'ControladorProducto@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR PRODUCTOS                          */
    /* --------------------------------------------- */
    Route::get('/admin/promos', 'ControladorPromo@index');
    Route::get('/admin/promo/nuevo', 'ControladorPromo@nuevo');
    Route::post('/admin/promo/nuevo', 'ControladorPromo@guardar');
    Route::get('/admin/promo/cargarGrilla', 'ControladorPromo@cargarGrilla')->name('promo.cargarGrilla');
    Route::get('/admin/promo/eliminar', 'ControladorPromo@eliminar');
    Route::get('/admin/promo/{id}', 'ControladorPromo@editar');
    Route::post('/admin/promo/{id}', 'ControladorPromo@guardar');
    

    /* --------------------------------------------- */
    /* CONTROLADOR PEDIDOS                          */
    /* --------------------------------------------- */
    Route::get('/admin/pedidos', 'ControladorPedido@index');
    Route::get('/admin/pedido/nuevo', 'ControladorPedido@nuevo');
    Route::post('/admin/pedido/nuevo', 'ControladorPedido@guardar');
    Route::get('/admin/pedido/cargarGrilla', 'ControladorPedido@cargarGrilla')->name('pedido.cargarGrilla');
    Route::get('/admin/pedido/eliminar', 'ControladorPedido@eliminar');
    Route::get('/admin/pedido/{id}', 'ControladorPedido@editar');
    Route::post('/admin/pedido/{id}', 'ControladorPedido@guardar');


    /* --------------------------------------------- */
    /* CONTROLADOR POSTULACIONES                          */
    /* --------------------------------------------- */
    Route::get('/admin/postulaciones', 'ControladorPostulacion@index');
    Route::get('/admin/postulacion/nuevo', 'ControladorPostulacion@nuevo');
    Route::post('/admin/postulacion/nuevo', 'ControladorPostulacion@guardar');
    Route::get('/admin/postulacion/cargarGrilla', 'ControladorPostulacion@cargarGrilla')->name('postulacion.cargarGrilla');
    Route::get('/admin/postulacion/eliminar', 'ControladorPostulacion@eliminar');
    Route::get('/admin/postulacion/{id}', 'ControladorPostulacion@editar');
    Route::post('/admin/postulacion/{id}', 'ControladorPostulacion@guardar');

    
    /* --------------------------------------------- */
    /* CONTROLADOR SUCURSALES                          */
    /* --------------------------------------------- */

    Route::get('/admin/sucursales', 'ControladorSucursal@index');
    Route::get('/admin/sucursal/nuevo', 'ControladorSucursal@nuevo');
    Route::post('/admin/sucursal/nuevo', 'ControladorSucursal@guardar');
    Route::get('/admin/sucursal/cargarGrilla', 'ControladorSucursal@cargarGrilla')->name('sucursal.cargarGrilla');
    Route::get('/admin/sucursal/eliminar', 'ControladorSucursal@eliminar');
    Route::get('/admin/sucursal/{id}', 'ControladorSucursal@editar');
    Route::post('/admin/sucursal/{id}', 'ControladorSucursal@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR SPONSORS                        */
    /* --------------------------------------------- */
    Route::get('/admin/sponsors', 'ControladorSponsor@index');
    Route::get('/admin/sponsors/nuevo', 'ControladorSponsor@nuevo');
    Route::post('/admin/sponsors/nuevo', 'ControladorSponsor@guardar');
    Route::get('/admin/sponsors/cargarGrilla', 'ControladorSponsor@cargarGrilla')->name('sponsor.cargarGrilla');
    Route::get('/admin/sponsors/eliminar', 'ControladorSponsor@eliminar');
    Route::get('/admin/sponsors/{id}', 'ControladorSponsor@editar');
    Route::post('/admin/sponsors/{id}', 'ControladorSponsor@guardar');

    
});

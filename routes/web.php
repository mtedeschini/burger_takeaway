<?php
 //use Carbon\Carbon; 
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

/*Route::get('/time' , function(){$date =new Carbon;echo $date ; } );*/


Route::group(array('domain' => '127.0.0.1'), function () {

    Route::get('/', 'ControladorWebHome@index');
    Route::get('/nosotros', 'ControladorWebNosotros@index');
    Route::post('/nosotros', 'ControladorWebNosotros@store');
    Route::get('/takeaway', 'ControladorWebTakeaway@index');
    Route::post('/takeaway', 'ControladorWebTakeaway@guardar');
    Route::get('/promociones', 'ControladorWebPromociones@index');
    Route::get('/contacto', 'ControladorWebContacto@index');
    Route::post('/contacto', 'ControladorWebContacto@enviarCorreo');
    Route::get('/mi-cuenta', 'ControladorWebMiCuenta@index');
    Route::get('/login', 'ControladorWebLogin@index');
    Route::post('/login', 'ControladorWebLogin@ingresar');
    Route::get('/carrito', 'ControladorWebCarrito@index');
    Route::post('/carrito', 'ControladorWebCarrito@finalizarPedido');
    Route::get('/registro', 'ControladorWebRegistro@index');
    Route::post('/registro', 'ControladorWebRegistro@guardar');
    Route::get('/logout', 'ControladorWebLogin@cerrarSesion');
    Route::get('/recibido', 'ControladorWebRecibido@index');
    Route::get('/sponsors', 'ControladorWebSponsor@index');
   // Route::get('/sponsorsResponse', 'ControladorWebSponsor@responseMail');
    
   // Route::get('/sponsorsResponse', 'ControladorWebSponsor@index');
    Route::post('/sponsorsResponse', 'ControladorWebSponsor@responseMail');
    Route::get('/creado', 'ControladorWebCreado@index');

    Route::get('/mercado-pago/aprobado/{id}', 'ControladorWebCarrito@mercadoPagoAprobado');
    Route::get('/mercado-pago/pendiente/{id}', 'ControladorWebCarrito@mercadoPagoPendiente');
    Route::get('/mercado-pago/error/{id}', 'ControladorWebCarrito@mercadoPagoError');


    Route::get('/admin', 'ControladorHome@index');
    Route::post('/admin/patente/nuevo', 'ControladorPatente@guardar');

/* --------------------------------------------- */
/* CONTROLADOR LOGIN                           */
/* --------------------------------------------- */
    Route::get('/admin/login', 'ControladorLogin@index');
    Route::get('/admin/logout', 'ControladorLogin@logout');
    Route::post('/admin/logout', 'ControladorLogin@entrar');
    Route::post('/admin/login', 'ControladorLogin@entrar');

/* --------------------------------------------- */
/* CONTROLADOR RECUPERO CLAVE                    */
/* --------------------------------------------- */
    Route::get('/admin/recupero-clave', 'ControladorRecuperoClave@index');
    Route::post('/admin/recupero-clave', 'ControladorRecuperoClave@recuperar');

/* --------------------------------------------- */
/* CONTROLADOR PERMISO                           */
/* --------------------------------------------- */
    Route::get('/admin/usuarios/cargarGrillaFamiliaDisponibles', 'ControladorPermiso@cargarGrillaFamiliaDisponibles')->name('usuarios.cargarGrillaFamiliaDisponibles');
    Route::get('/admin/usuarios/cargarGrillaFamiliasDelUsuario', 'ControladorPermiso@cargarGrillaFamiliasDelUsuario')->name('usuarios.cargarGrillaFamiliasDelUsuario');
    Route::get('/admin/permisos', 'ControladorPermiso@index');
    Route::get('/admin/permisos/cargarGrilla', 'ControladorPermiso@cargarGrilla')->name('permiso.cargarGrilla');
    Route::get('/admin/permiso/nuevo', 'ControladorPermiso@nuevo');
    Route::get('/admin/permiso/cargarGrillaPatentesPorFamilia', 'ControladorPermiso@cargarGrillaPatentesPorFamilia')->name('permiso.cargarGrillaPatentesPorFamilia');
    Route::get('/admin/permiso/cargarGrillaPatentesDisponibles', 'ControladorPermiso@cargarGrillaPatentesDisponibles')->name('permiso.cargarGrillaPatentesDisponibles');
    Route::get('/admin/permiso/{idpermiso}', 'ControladorPermiso@editar');
    Route::post('/admin/permiso/{idpermiso}', 'ControladorPermiso@guardar');

/* --------------------------------------------- */
/* CONTROLADOR GRUPO                             */
/* --------------------------------------------- */
    Route::get('/admin/grupos', 'ControladorGrupo@index');
    Route::get('/admin/usuarios/cargarGrillaGruposDelUsuario', 'ControladorGrupo@cargarGrillaGruposDelUsuario')->name('usuarios.cargarGrillaGruposDelUsuario'); //otra cosa
    Route::get('/admin/usuarios/cargarGrillaGruposDisponibles', 'ControladorGrupo@cargarGrillaGruposDisponibles')->name('usuarios.cargarGrillaGruposDisponibles'); //otra cosa
    Route::get('/admin/grupos/cargarGrilla', 'ControladorGrupo@cargarGrilla')->name('grupo.cargarGrilla');
    Route::get('/admin/grupo/nuevo', 'ControladorGrupo@nuevo');
    Route::get('/admin/grupo/setearGrupo', 'ControladorGrupo@setearGrupo');
    Route::post('/admin/grupo/nuevo', 'ControladorGrupo@guardar');
    Route::get('/admin/grupo/{idgrupo}', 'ControladorGrupo@editar');
    Route::post('/admin/grupo/{idgrupo}', 'ControladorGrupo@guardar');

/* --------------------------------------------- */
/* CONTROLADOR USUARIO                           */
/* --------------------------------------------- */
    Route::get('/admin/usuarios', 'ControladorUsuario@index');
    Route::get('/admin/usuarios/nuevo', 'ControladorUsuario@nuevo');
    Route::post('/admin/usuarios/nuevo', 'ControladorUsuario@guardar');
    Route::post('/admin/usuarios/{usuario}', 'ControladorUsuario@guardar');
    Route::get('/admin/usuarios/cargarGrilla', 'ControladorUsuario@cargarGrilla')->name('usuarios.cargarGrilla');
    Route::get('/admin/usuarios/buscarUsuario', 'ControladorUsuario@buscarUsuario');
    Route::get('/admin/usuarios/{usuario}', 'ControladorUsuario@editar');

/* --------------------------------------------- */
/* CONTROLADOR MENU                             */
/* --------------------------------------------- */
    Route::get('/admin/sistema/menu', 'ControladorMenu@index');
    Route::get('/admin/sistema/menu/nuevo', 'ControladorMenu@nuevo');
    Route::post('/admin/sistema/menu/nuevo', 'ControladorMenu@guardar');
    Route::get('/admin/sistema/menu/cargarGrilla', 'ControladorMenu@cargarGrilla')->name('menu.cargarGrilla');
    Route::get('/admin/sistema/menu/eliminar', 'ControladorMenu@eliminar');
    Route::get('/admin/sistema/menu/{id}', 'ControladorMenu@editar');
    Route::post('/admin/sistema/menu/{id}', 'ControladorMenu@guardar');

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
    Route::post('/admin/postulacion/nuevo', 'ControladorPostulacion@guardar')->name('postulacion.nuevo');
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
    Route::get('/admin/sponsors/cargarGrilla', 'ControladorSponsor@cargarGrilla')->name('sponsors.cargarGrilla');
    Route::get('/admin/sponsors/eliminar', 'ControladorSponsor@eliminar');
    Route::get('/admin/sponsors/{id}', 'ControladorSponsor@editar');
    Route::post('/admin/sponsors/{id}', 'ControladorSponsor@guardar');

});

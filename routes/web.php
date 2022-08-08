<?php
use Illuminate\Support\Facades\DB;
use Doctrine\DBAL\Schema\Index;
// saber cuales son las consultas que se realizan a la base de datos 
// DB::listen(function ( $query){
//     var_dump($query->sql);
// });
// use DB;

Route::group(['middleware' => ['navegador', 'headerSeguro']], function() {
    require_once __DIR__ . '/public/authRoutes.php';
    Route::match(['GET', 'HEAD'],'costo-de-envio/opciones/{id_armado}', 'CostoDeEnvio\OpcionesCostosController@getOpcionesCostos')->name('costoDeEnvio.opcionesCostos');
    Route::match(['GET', 'HEAD'],'costo-de-envio/opciones/direccion/{id_direccion}', 'CostoDeEnvio\OpcionesCostosController@getOpcionesDirecciones')->name('costoDeEnvio.opcionesCostos.direccion');
    Route::match(['GET', 'HEAD'],'solicitar-soporte','TecnologiaDeLaInformacion\SoporteController@create')->name('soporte.create');
    Route::post('solicitar-soporte/almacenar', 'TecnologiaDeLaInformacion\SoporteController@store')->name('soporte.store');
    Route::get('/offline', function() {
        return view('vendor.laravelpwa.offline');
    });
    
    Route::group(['middleware' => ['sinAccesoAlSistema', 'auth', 'idiomaSistema', 'primerAcceso']], function() {
        Route::get('/home', 'HomeController@index')->name('home');
        require_once __DIR__ . '/material/materialRoutes.php';
        
        Route::group(['middleware' => ['rolCliente'], 'prefix' => 'rc'], function() {
            require_once __DIR__ . '/rolCliente/cotizacionRoutes/cotizacionRoutes.php';
            require_once __DIR__ . '/rolCliente/datoFiscalRoutes/datoFiscalRoutes.php';
            require_once __DIR__ . '/rolCliente/direccionRoutes/direccionRoutes.php';
            require_once __DIR__ . '/rolCliente/facturaRoutes/facturaRoutes.php';
            require_once __DIR__ . '/rolCliente/pagoRoutes/pagoRoutes.php';
            require_once __DIR__ . '/rolCliente/pedidoRoutes/pedidoRoutes.php';
            require_once __DIR__ . '/rolCliente/comprobantesRoutes/comprobantesRoutes.php';
        }); 
        
        Route::group(['middleware' => ['rolFerro'], 'prefix' => 'f'], function() {
            require_once __DIR__ . '/rolFerro/rutaRoutes.php';
            require_once __DIR__ . '/rolFerro/envioRoutes.php';
            Route::get('index', function () {
                return 'index ';
            });
        }); 
        
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs.index')->middleware('permission:logs.index');
        require_once __DIR__ . '/layouts/layoutsRoutes.php';
        require_once __DIR__ . '/usuario/usuarioRoutes.php';
        require_once __DIR__ . '/quejasYSugerencias/quejasYSugerenciasRoutes.php';
        require_once __DIR__ . '/cliente/clienteRoutes.php';
        require_once __DIR__ . '/papeleraDeReciclaje/papeleraDeReciclajeRoutes.php';
        require_once __DIR__ . '/proveedor/proveedorRoutes.php';
        require_once __DIR__ . '/armado/armadoRoutes.php';
        require_once __DIR__ . '/costoDeEnvio/costoDeEnvioRoutes.php';
        require_once __DIR__ . '/cotizacion/cotizacionRoutes.php';
        require_once __DIR__ . '/factura/facturaRoutes.php';
        require_once __DIR__ . '/estado/estadoRoutes.php';
        require_once __DIR__ . '/metodoDeEntrega/tipoDeEnvioRoutes.php';
        require_once __DIR__ . '/stock/stockRoutes.php';
        require_once __DIR__ . '/categoria/categoriaRoutes.php';
        require_once __DIR__ . '/subCategoria/subCategoriaRoutes.php';
        require_once __DIR__ . '/marca/marcaRoutes.php';
        require_once __DIR__ . '/etiqueta/etiquetaRoutes.php';
        
        Route::group(['prefix' => 'job'], function() {
            require_once __DIR__ . '/jobs/jobsRoutes.php';
        });
        
        Route::group(['prefix' => 'pago'], function() {
            require_once __DIR__ . '/pago/pagoFPedidoRoutes.php';
            require_once __DIR__ . '/pago/pagoIndividualRoutes.php';
        });
        
        Route::group(['prefix' => 'ti'], function(){
            require_once __DIR__ . '/tecnologiaDeLaInformacion/tiRoutes.php';
            require_once __DIR__ . '/tecnologiaDeLaInformacion/soporteRoutes.php';
            require_once __DIR__ . '/tecnologiaDeLaInformacion/inventarioRoutes.php';
        });
        
        Route::group(['prefix' => 'rastrea'], function() {
            require_once __DIR__ . '/rastrea/rastreaPedidoRoutes.php';
        });
        
        Route::group(['prefix' => 'perfil'], function() {
            require_once __DIR__ . '/perfil/perfilRoutes.php';
            require_once __DIR__ . '/perfil/notificacionRoutes.php';
            require_once __DIR__ . '/perfil/archivoGeneradoRoutes.php';
            require_once __DIR__ . '/perfil/recordatorioRoutes.php';
        });
        
        Route::group(['prefix' => 'sistema'], function() {
            require_once __DIR__ . '/sistema/sistemaRoutes.php';
            require_once __DIR__ . '/sistema/manualRoutes.php';
            require_once __DIR__ . '/sistema/plantillaRoutes.php';
            require_once __DIR__ . '/sistema/notificacionRoutes.php';
            require_once __DIR__ . '/sistema/actividadRoutes.php';
            require_once __DIR__ . '/sistema/catalogoRoutes.php';
            require_once __DIR__ . '/sistema/serieRoutes.php';
        });
        
        Route::group(['prefix' => 'rol'], function() {
            require_once __DIR__ . '/rol/rolRoutes.php';
            require_once __DIR__ . '/rol/permisoRoutes.php';
        });
        
        Route::group(['prefix' => 'venta'], function() {
            require_once __DIR__ . '/venta/ventaRoutes.php';
            require_once __DIR__ . '/venta/pedidoActivoRoutes.php';
            require_once __DIR__ . '/venta/pedidoTerminadoRoutes.php';
        });
        
        Route::group(['prefix' => 'almacen'], function() {
            require_once __DIR__ . '/almacen/almacenRoutes.php';
            require_once __DIR__ . '/almacen/pedidoActivoRoutes.php';
            require_once __DIR__ . '/almacen/pedidoTerminadoRoutes.php';
            require_once __DIR__ . '/almacen/productoRoutes.php';
            require_once __DIR__ . '/almacen/notaRemisionRoutes.php';
        });
        
        Route::group(['prefix' => 'produccion'], function() {
            require_once __DIR__ . '/produccion/produccionRoutes.php';
            require_once __DIR__ . '/produccion/pedidoActivoRoutes.php';
            require_once __DIR__ . '/produccion/pedidoTerminadoRoutes.php';
        });

        Route::group(['prefix'  =>  'categoria'], function(){
            require_once __DIR__ . '/categoria/categoriaRoutes.php';
        });

        Route::group(['prefix'  =>  'subCategoria'], function(){
            require_once __DIR__ . '/subCategoria/subCategoriaRoutes.php';
        });

        Route::group(['prefix'  =>  'marca'], function(){
            require_once __DIR__ . '/marca/marcaRoutes.php';
        });

        Route::group(['prefix'  =>  'etiqueta'], function(){
            require_once __DIR__ . '/etiqueta/etiquetaRoutes.php';
        });
        // ================= ventas =======================
        Route::get('/venta/pedido-activo/getfecha/{fecha}','Venta\PedidoActivo\PedidoActivoController@total')->middleware('permission:venta.pedidoActivo.edit|venta.pedidoActivo.armado.edit|venta.pedidoActivo.pago.create|venta.pedidoActivo.pago.edit');

       
         /** ----------------------------------------------------------------------------------------- */
        
        Route::group(['prefix' => 'logistica'], function() {
            require_once __DIR__ . '/logistica/logisticaRoutes.php';
            require_once __DIR__ . '/logistica/pedidoActivoRoutes.php';
            require_once __DIR__ . '/logistica/pedidoEntregadoRoutes.php';
            require_once __DIR__ . '/logistica/direccionEstregadaRoutes.php';
            
            Route::group(['prefix' => 'direccion'], function() {
                Route::match(['GET', 'HEAD'],'metodo-de-entrega/{for_loc}', 'Logistica\DireccionLocal\DireccionLocalController@metodoDeEntrega')->name('logistica.metodoDeEntrega')->middleware('permission:costoDeEnvio.create|costoDeEnvio.edit');
                Route::match(['GET', 'HEAD'],'metodo-de-entrega-espescifico/{id_metodo_de_entrega}', 'Logistica\DireccionLocal\DireccionLocalController@metodoDeEntregaEspecifico')->name('logistica.metodoDeEntregaEspecifico')->middleware('permission:logistica.direccionLocal.create|logistica.direccionLocal.createEntrega|logistica.direccionForaneo.create|logistica.direccionForaneo.createEntrega|costoDeEnvio.create|costoDeEnvio.edit');
                Route::match(['GET', 'HEAD'],'generar-comprobante-de-entrega/{id_direccion}/{for_loc}', 'Logistica\DireccionLocal\DireccionLocalController@generarComprobanteDeEntrega')->name('logistica.direccion.generarComprobanteDeEntrega')->middleware('permission:logistica.direccionLocal.index|logistica.direccionForaneo.index');
                require_once __DIR__ . '/logistica/direccionLocalRoutes.php';
                require_once __DIR__ . '/logistica/direccionForaneaRoutes.php';
            });
        });
    });
});
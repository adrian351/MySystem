<?php
namespace App\Repositories\sistema\sistema;
// Models
use App\Models\Sistema;
// Events
use App\Events\layouts\ArchivoCargado;
use App\Events\layouts\ActividadRegistrada;
// Otros
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SistemaRepositories implements SistemaInterface {
  public function sistemaFindOrFail() {
    $datos = Cache::rememberForever('sistema', function() { // Guarda la información en la cache con la llave "sistema"
      return Sistema::findOrFail(1);
    });
    return $datos;
  }
  public function update($request) {
    $sistema = $this->sistemaFindOrFail();
    $sistema->emp                 = $request->nombre_de_la_empresa;
    $sistema->emp_abrev           = $request->nombre_de_la_empresa_abreviado;
    $sistema->year_de_ini         = $request->year_de_inicio;
    $sistema->lad_fij             = $request->lada_telefono_fijo;
    $sistema->tel_fij             = $request->telefono_fijo;
    $sistema->ext                 = $request->extension;
    $sistema->lad_mov             = $request->lada_telefono_movil;
    $sistema->tel_mov             = $request->telefono_movil;
    $sistema->direc_uno           = $request->direccion_uno;
    $sistema->direc_dos           = $request->direccion_dos;
    $sistema->direc_tres          = $request->direccion_tres;
    $sistema->corr_vent           = $request->correo_ventas;
    $sistema->corr_opc_uno        = $request->correo_opcion_uno;
    $sistema->corr_opc_dos        = $request->correo_opcion_dos;
    $sistema->corr_opc_tres       = $request->correo_opcion_tres;
    $sistema->pag                 = $request->pagina_web;
    $sistema->red_fbk             = $request->facebook;
    $sistema->red_tw              = $request->twitter;
    $sistema->red_ins             = $request->instagram;
    $sistema->red_link            = $request->linkedin;
    $sistema->red_youtube         = $request->youtube;
    $sistema->ser_cotizaciones    = $request->serie_por_default_cotizaciones;
    $sistema->ser_pedidos         = $request->serie_por_default_pedidos;
    $sistema->plant_usu_bien      = $request->plantilla_por_default_bienvenida_usuarios;
    $sistema->plant_cli_bien      = $request->plantilla_por_default_bienvenida_clientes;
    $sistema->plant_per_camb_pass = $request->plantilla_por_default_cambio_de_password;
    $sistema->plant_sis_rest_pass = $request->plantilla_por_default_restablecimiento_de_password;
    $sistema->plant_cot_term_cond = $request->plantilla_por_default_terminos_y_condiciones;
    $sistema->plant_vent_reg_ped  = $request->plantilla_por_default_registrar_pedido;
    $sistema->plant_vent_ped_can  = $request->plantilla_por_default_pedido_cancelado;
    $sistema->plant_pag_reg_pag   = $request->plantilla_por_default_registrar_pago;
    $sistema->plant_pag_pag_rech  = $request->plantilla_por_default_pago_rechazado;
    $sistema->plant_fac_generada  = $request->plantilla_por_default_factura_generada;
    $sistema->plant_fac_cancelado  = $request->plantilla_por_default_factura_cancelada;
    $sistema->plant_ped_ent  = $request->plantilla_por_default_pedido_entregado;
    
    if($sistema->isDirty()) {
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ActividadRegistrada::dispatch(
        'Sistema', // Módulo
        'sistema.edit', // Nombre de la ruta
        null, // Id del registro debe ir encriptado
        $request->nombre_de_la_empresa_abreviado, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
        array('Nombre de la empresa', 'Nombre de la empresa abreviado', 'Año de inicio', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Dirección uno', 
              'Dirección dos', 'Dirección tres', 'Correo ventas', 'Correo opción uno', 'Correo opción dos', 'Correo opción tres', 'Página web', 'Facebook', 'Twitter', 'Instagram', 'Linkedin', 
              'Youtube', 'Serie por default "Cotizaciones"', 'Serie por default "Pedidos"', 'Plantilla por default "Bienvenida"', 'Plantilla por default "Bienvenida"', 'Plantilla por default "Cambio de contraseña"', 
              'Plantilla por default "Restablecimiento de contraseña"', 'Plantilla por default "Términos y condiciones"', 'Plantilla por default "Registrar pedido"', 'Plantilla por default "Pedido cancelado"', 
              'Plantilla por default "Registrar pago"', 'Plantilla por default "Pago rechazado"', 'Plantilla por default "Factura generada"', 'Plantilla por default "Factura cancelada"', 'Plantilla por default "Pedido entregado"'), // Nombre de los inputs del formulario
        $sistema, // Request
        array('emp', 'emp_abrev', 'year_de_ini', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'direc_uno', 'direc_dos', 'direc_tres', 'corr_vent', 'corr_opc_uno', 'corr_opc_dos', 'corr_opc_tres', 'pag', 
        'red_fbk', 'red_tw', 'red_ins', 'red_link', 'red_youtube', 'ser_cotizaciones', 'ser_pedidos', 'plant_usu_bien', 'plant_cli_bien', 'plant_per_camb_pass', 'plant_sis_rest_pass', 'plant_cot_term_cond', 
        'plant_vent_reg_ped', 'plant_vent_ped_can', 'plant_pag_reg_pag', 'plant_pag_pag_rech', 'plant_fac_generada', 'plant_fac_cancelado', 'plant_ped_ent') // Nombre de los campos en la BD
      ); 
      $sistema->updated_at_sis  = Auth::user()->email_registro;
    }
    $ruta_arch = 'sistema';
    if($request->hasfile('logo_color_negro')) {
      $logo_color_negro = ArchivoCargado::dispatch(
        $request->file('logo_color_negro'), // Archivo (blob)
        $ruta_arch, // Ruta donde se guardara el archivo
        'logo-negro-' . time() . '.', // Nombre del archivo
        $sistema->log_neg // Ruta original del archivo en caso de se este remplazando por uno nuevo
      ); 
      $sistema->log_neg_rut     = $logo_color_negro[0]['ruta'];
      $sistema->log_neg         = $logo_color_negro[0]['nombre'];
    }
    if($request->hasfile('logo_color_blanco')) {
      $logo_color_blanco = ArchivoCargado::dispatch(
        $request->file('logo_color_blanco'),  // Archivo (blob)
        $ruta_arch, // Ruta donde se guardara el archivo
        'logo-blanco-' . time() . '.',  // Nombre del archivo
        $sistema->log_blan // Ruta original del archivo en caso de se este remplazando por uno nuevo
      );
      $sistema->log_blan_rut    = $logo_color_blanco[0]['ruta'];
      $sistema->log_blan        = $logo_color_blanco[0]['nombre'];
    }
    if($request->hasfile('imagen_login')) {
      $imagen_login = ArchivoCargado::dispatch(
        $request->file('imagen_login'),  // Archivo (blob)
        $ruta_arch, // Ruta donde se guardara el archivo
        'carrusel-login-' . time() . '.',  // Nombre del archivo
        $sistema->carrus_login // Ruta original del archivo en caso de se este remplazando por uno nuevo
      );
      $sistema->carrus_login_rut     = $imagen_login[0]['ruta'];
      $sistema->carrus_login         = $imagen_login[0]['nombre'];
    }
    if($request->hasfile('imagen_restablecer_la_contraseña')) {
      $imagen_restablecer_la_contraseña = ArchivoCargado::dispatch(
        $request->file('imagen_restablecer_la_contraseña'),  // Archivo (blob)
        $ruta_arch, // Ruta donde se guardara el archivo
        'carrusel-request-' . time() . '.',  // Nombre del archivo
        $sistema->carrus_reque // Ruta original del archivo en caso de se este remplazando por uno nuevo
      );
      $sistema->carrus_reque_rut    = $imagen_restablecer_la_contraseña[0]['ruta'];
      $sistema->carrus_reque        = $imagen_restablecer_la_contraseña[0]['nombre'];
    }
    if($request->hasfile('imagen_nueva_contraseña')) {
      $imagen_nueva_contraseña = ArchivoCargado::dispatch(
        $request->file('imagen_nueva_contraseña'),  // Archivo (blob)
        $ruta_arch, // Ruta donde se guardara el archivo
        'carrusel-reset-' . time() . '.',  // Nombre del archivo
        $sistema->carrus_rese // Ruta original del archivo en caso de se este remplazando por uno nuevo
      );
      $sistema->carrus_rese_rut     = $imagen_nueva_contraseña[0]['ruta'];
      $sistema->carrus_rese         = $imagen_nueva_contraseña[0]['nombre'];
    }
    if($request->hasfile('imagen_predeterminada_del_perfil')) {
      $imagen_predeterminada_del_perfil = ArchivoCargado::dispatch(
        $request->file('imagen_predeterminada_del_perfil'),  // Archivo (blob)
        $ruta_arch, // Ruta donde se guardara el archivo
        'default-perfil-' . time() . '.',  // Nombre del archivo
        $sistema->defau_img_perf // Ruta original del archivo en caso de se este remplazando por uno nuevo
      );
      $sistema->defau_img_perf_rut    = $imagen_predeterminada_del_perfil[0]['ruta'];
      $sistema->defau_img_perf        = $imagen_predeterminada_del_perfil[0]['nombre'];
    }
    if($request->hasfile('imagen_modulo_en_desarrollo')) {
      $imagen_modulo_en_desarrollo = ArchivoCargado::dispatch(
        $request->file('imagen_modulo_en_desarrollo'),  // Archivo (blob)
        $ruta_arch, // Ruta donde se guardara el archivo
        'en-construccion-' . time() . '.',  // Nombre del archivo
        $sistema->img_construc // Ruta original del archivo en caso de se este remplazando por uno nuevo
      );
      $sistema->img_construc_rut     = $imagen_modulo_en_desarrollo[0]['ruta'];
      $sistema->img_construc         = $imagen_modulo_en_desarrollo[0]['nombre'];
    }
    if($request->hasfile('imagen_error')) {
      $imagen_error = ArchivoCargado::dispatch(
        $request->file('imagen_error'),  // Archivo (blob)
        $ruta_arch, // Ruta donde se guardara el archivo
        'error-' . time() . '.',  // Nombre del archivo
        $sistema->error // Ruta original del archivo en caso de se este remplazando por uno nuevo
      );
      $sistema->error_rut     = $imagen_error[0]['ruta'];
      $sistema->error         = $imagen_error[0]['nombre'];
    }
    $sistema->save();
    Cache::pull('sistema'); // Elimina la cache con el nombre espesificado
    return $sistema;
  }
  public function datos($campo) {
    return Sistema::datos()->sistemaFindOrFail()->$campo;
  }
}
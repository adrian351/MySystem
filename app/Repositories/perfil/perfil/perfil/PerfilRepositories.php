<?php
namespace App\Repositories\perfil\perfil\perfil;
// Models
// Notifications
use App\Notifications\perfil\perfil\editar\NotificacionPasswordCambiado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\usuario\UsuarioRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PerfilRepositories implements PerfilInterface {
  protected $serviceCrypt;
  protected $usuarioRepo;
  protected $plantillaRepo;
  protected $sistemaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, UsuarioRepositories $usuarioRepositories, PlantillaRepositories $plantillaRepositories, SistemaRepositories $sistemaRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->usuarioRepo    = $usuarioRepositories;
    $this->plantillaRepo  = $plantillaRepositories;
    $this->sistemaRepo    = $sistemaRepositories;
  } 
  public function update($request) {
    DB::transaction(function() use($request) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $perfil               = $this->usuarioRepo->getUsuarioFindOrFail(Auth::user()->id, []);
      $perfil->nom          = $request->nombre;
      $perfil->apell        = $request->apellidos;
      $perfil->email        = $request->correo_de_acceso;
      $perfil->email_secund = $request->correo_secundario;
      $perfil->lad_fij      = $request->lada_telefono_fijo;
      $perfil->tel_fij      = $request->telefono_fijo;
      $perfil->ext          = $request->extension;
      $perfil->lad_mov      = $request->lada_telefono_movil;
      $perfil->tel_mov      = $request->telefono_movil;
      $perfil->emp          = $request->empresa;
      if($perfil->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Perfil', // Módulo
          'perfil.edit', // Nombre de la ruta
          null, // Id del registro debe ir encriptado
          $request->nombre, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre', 'Apellidos', 'Correo de acceso', 'Correo secundario', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Empresa'), // Nombre de los inputs del formulario
          $perfil, // Request
          array('nom', 'apell', 'email', 'email_secund', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'emp') // Nombre de los campos en la BD
        );
        $perfil->updated_at_us= Auth::user()->email_registro;
      }
      if($request->password != null) {
        // Envía notificación por correo electronico de contraseña cambiada
        $plantilla = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_per_camb_pass'));
        Auth::user()->notify(new NotificacionPasswordCambiado($plantilla));
        $perfil->password = $this->serviceCrypt->bcrypt($request->password); 
      }
      if($request->hasfile('imagen')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('imagen'), // Archivo blob
          'perfil', // Ruta en la que guardara el archivo
          'perfil-'.time().'.', // Nombre del archivo
          $perfil->img_us // Ruta y nombre del archivo anterior
        ); 
        $perfil->img_us_rut = $imagen[0]['ruta'];
        $perfil->img_us     = $imagen[0]['nombre'];
      }
      $perfil->save();
      return $perfil;
    });
  }
}
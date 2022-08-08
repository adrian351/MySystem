<?php
namespace App\Repositories\usuario;
// Models
use App\User;
// Notifications
use App\Notifications\usuario\NotificacionBienvenidaUsuario;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use DB;

class UsuarioRepositories implements UsuarioInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  protected $plantillaRepo;
  protected $sistemaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, PlantillaRepositories $plantillaRepositories, SistemaRepositories $sistemaRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
    $this->plantillaRepo              = $plantillaRepositories;
    $this->sistemaRepo                = $sistemaRepositories;
  } 
  public function usuarioAsignadoFindOrFailById($id_usuario, $acceso, $relaciones = null) {
    $id_usuario = $this->serviceCrypt->decrypt($id_usuario);
    $usuario = User::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->where('acceso', $acceso)->where('id', '!=', Auth::user()->id)->with(['roles'=> function ($query) {
      $query->orderBy('nom', 'ASC');
    }])->with($relaciones)->findOrFail($id_usuario);
    return $usuario;
  }
  public function getPagination($request, $acceso) {
    return User::with('roles')->where('acceso', $acceso)->where('id', '!=', Auth::user()->id)->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    // dd($request);
    DB::transaction(function() use($request) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $usuario = new User();
      $usuario->acceso              = 1; // 1 = Ecceso como usuario
      $usuario->registros_tab_acces = 1; // 1 = Puede visualizar todos los registros de las tablas de los diferentes modulos
      $usuario->nom                 = $request->nombre;
      $usuario->apell               = $request->apellidos;
      $usuario->email_registro      = $request->correo_de_registro;
      $usuario->email               = $request->correo_de_registro;
      $usuario->email_secund        = $request->correo_secundario;
      $usuario->lad_fij             = $request->lada_telefono_fijo;
      $usuario->tel_fij             = $request->telefono_fijo;
      $usuario->ext                 = $request->extension;
      $usuario->lad_mov             = $request->lada_telefono_movil;
      $usuario->tel_mov             = $request->telefono_movil;
      $usuario->emp                 = $request->empresa;
      $usuario->password            = $this->serviceCrypt->bcrypt($request->password);
      $usuario->obs                 = $request->observaciones;
      $usuario->asignado_us         = Auth::user()->email_registro;
      $usuario->created_at_us       = Auth::user()->email_registro;
      if($request->hasfile('imagen')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('imagen'), // Archivo blob
          'perfil', // Ruta en la que guardara el archivo
          'perfil-'.time().'.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $usuario->img_us_rut  = $imagen[0]['ruta'];
        $usuario->img_us      = $imagen[0]['nombre'];
      }
      $usuario->save();
      $usuario->roles()->sync($request->rol);
      if($request->checkbox_correo == 'on') {
        $plantilla = $this->plantillaRepo->plantillaFindOrFailById($request->plantilla);
        $usuario->notify(new NotificacionBienvenidaUsuario($usuario, $request->password, $plantilla)); // Envió de correo electrónico
      }
      return $usuario;
    });
  }
  public function update($request, $id_usuario) {
    DB::transaction(function() use($request, $id_usuario) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $usuario = $this->usuarioAsignadoFindOrFailById($id_usuario, '1', []);
      $usuario->nom                 = $request->nombre;
      $usuario->apell               = $request->apellidos;
      $usuario->email               = $request->correo_de_acceso;
      $usuario->email_secund        = $request->correo_secundario;
      $usuario->lad_fij             = $request->lada_telefono_fijo;
      $usuario->tel_fij             = $request->telefono_fijo;
      $usuario->ext                 = $request->extension;
      $usuario->lad_mov             = $request->lada_telefono_movil;
      $usuario->tel_mov             = $request->telefono_movil;
      $usuario->emp                 = $request->empresa;
      $usuario->obs                 = $request->observaciones;
      $usuario->notif               = $request->notificaciones;
      $usuario->registros_tab_acces = $request->acceso_a_todos_los_registros;
      if($usuario->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Usuarios', // Módulo
          'usuario.show', // Nombre de la ruta
          $id_usuario, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_usuario), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre(s)', 'Apellidos', 'Correo de acceso', 'Correo secundario', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Empresa', 'Observaciones', 'Notificaciones', 'Acceso a todos los registros'), // Nombre de los inputs del formulario
          $usuario, // Request
          array('nom', 'apell', 'email', 'email_secund', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'emp', 'obs', 'notif', 'registros_tab_acces') // Nombre de los campos en la BD
        ); 
        $usuario->updated_at_us  = Auth::user()->email_registro;
      }
      if($request->hasfile('imagen')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('imagen'), 
          'perfil', // Ruta en la que guardara el archivo
          'perfil-'.time().'.', // Nombre del archivo
          $usuario->img_us
        ); 
        $usuario->img_us_rut        = $imagen[0]['ruta'];
        $usuario->img_us            = $imagen[0]['nombre'];
      }
      $usuario->save();
      $usuario->roles()->sync($request->rol);
      return $usuario;
    });
  }
  public function destroy($id_usuario) {
    try { DB::beginTransaction();
      $usuario = $this->usuarioAsignadoFindOrFailById($id_usuario, '1', []);
      $usuario->delete();
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Usuarios', // Nombre del módulo del sistema
        'registro'    => $usuario->nom, // Información a mostrar en la papelera
        'tab'         => 'users', // Nombre de la tabla en la BD
        'id_reg'      => $usuario->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación           
      ]);
      DB::commit();
      return $usuario;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function reEnviarCorreoBienvenida($id_usuario) {
    try { DB::beginTransaction();
      $usuario = $this->usuarioAsignadoFindOrFailById($id_usuario, '1', []);
      if($usuario->email_verified_at != null) { // Si el usuario ya accedio una vez al sistema ya no dejara enviar correo de bienvenida
        DB::commit();
        return true;
      }
      // Generar contraseña aleatoria con el rango "longitud_del_password" espesificado en el archivo .env 
      $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!#%&()_-+=[}]<>/';
      $nueva_password = '';
      for ($i = 0; $i <config('app.longitud_del_password') ; $i++) { // Variable "longitud_del_password" definida en el archivo .env
        $nueva_password .= $caracteres[rand(0, strlen($caracteres) - 1)];
      }
      // FIN (Generar contraseña aleatoria con el rango "longitud_del_password" espesificado en el archivo .env )
      $usuario->password = $this->serviceCrypt->bcrypt($nueva_password);
      $usuario->save();
      $plantilla = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_usu_bien'));
      $usuario->notify(new NotificacionBienvenidaUsuario($usuario, $nueva_password, $plantilla)); // Envió de correo electrónico
      DB::commit();
      return false;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getUsuarioFindOrFail($id_usuario, $relaciones) {
    return User::with($relaciones)->findOrFail($id_usuario);
  }
  public function getAllUsersPlunk() {
    return User::where('email_registro', '!=', Auth::user()->email_registro)->where('notif', 'on')->orderBy('email_registro', 'ASC')->pluck('email_registro', 'id');
  }
  public function getAllClientesPlunk() {
    return User::where('acceso', '2')->orderBy('email_registro', 'ASC')->pluck('email_registro', 'email_registro');
  }
  public function getAllClientesIdPlunk() {
    return User::where('acceso', '2')->orderBy('email_registro', 'ASC')->pluck('email_registro', 'id');
  }
}
<?php
namespace App\Repositories\cliente;
// Models
use App\User;
// Notifications
use App\Notifications\cliente\NotificacionBienvenidaCliente;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\usuario\UsuarioRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ClienteRepositories implements ClienteInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  protected $usuarioRepo;
  protected $plantillaRepo;
  protected $sistemaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, UsuarioRepositories $usuarioRepositories, PlantillaRepositories $plantillaRepositories, SistemaRepositories $sistemaRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
    $this->usuarioRepo                = $usuarioRepositories;
    $this->plantillaRepo              = $plantillaRepositories;
    $this->sistemaRepo                = $sistemaRepositories;
  } 
  public function store($request) {
    // dd($request);
    DB::transaction(function() use($request) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $cliente = new User();
      $cliente->nom               = $request->nombre;
      $cliente->apell             = $request->apellidos;
      $cliente->email_registro    = $request->correo_de_registro;
      $cliente->email             = $request->correo_de_registro;
      $cliente->email_secund      = $request->correo_secundario;
      $cliente->lad_fij           = $request->lada_telefono_fijo;
      // if($request['lada_telefono_fijo'] != null || $request['lada_telefono_fijo'] != ''){
      //   $cliente->lad_fij = $request->lada_telefono_fijo;
      // }else{
      //   $cliente->lad_fij ='null';
      // }
      $cliente->tel_fij           = $request->telefono_fijo;
      $cliente->ext               = $request->extension;
      $cliente->lad_mov           = $request->lada_telefono_movil;
      // if($request['lada_telefono_movil'] != null || $request['lada_telefono_movil'] != ''){
      //   $cliente->lad_mov = $request->lada_telefono_movil;
      // }else{
      //   $cliente->lad_mov ='null';
      // }
      $cliente->tel_mov           = $request->telefono_movil;
      $cliente->emp               = $request->empresa;
      $cliente->password          = $this->serviceCrypt->bcrypt($request->password);
      $cliente->obs               = $request->observaciones;
      $cliente->asignado_us       = Auth::user()->email_registro;
      $cliente->created_at_us     = Auth::user()->email_registro;
      if($request->hasfile('imagen')) {
        $imagen = ArchivoCargado::dispatch(
          $request->file('imagen'), // Archivo blob
          'perfil', // Ruta en la que guardara el archivo
          'perfil-'.time().'.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $cliente->img_us_rut        = $imagen[0]['ruta'];
        $cliente->img_us            = $imagen[0]['nombre'];
      }
      $cliente->save();
      $cliente->roles()->sync($request->rol);
      if($request->checkbox_correo == 'on') {
        $plantilla = $this->plantillaRepo->plantillaFindOrFailById($request->plantilla);
        $cliente->notify(new NotificacionBienvenidaCliente($cliente, $request->password, $plantilla)); // Envió de correo electrónico
      }
      return $cliente;
    });
  }
  public function update($request, $id_cliente) {
    DB::transaction(function() use($request, $id_cliente) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $cliente = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2', []);
      $cliente->nom               = $request->nombre;
      $cliente->apell             = $request->apellidos;
      $cliente->email             = $request->correo_de_acceso;
      $cliente->email_secund      = $request->correo_secundario;
      $cliente->lad_fij           = $request->lada_telefono_fijo;
      $cliente->tel_fij           = $request->telefono_fijo;
      $cliente->ext               = $request->extension;
      $cliente->lad_mov           = $request->lada_telefono_movil;
      $cliente->tel_mov           = $request->telefono_movil;
      $cliente->emp               = $request->empresa;
      $cliente->obs               = $request->observaciones;
      $cliente->notif             = $request->notificaciones;
      if($cliente->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Clientes', // Módulo
          'cliente.show', // Nombre de la ruta
          $id_cliente, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_cliente), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre(s)', 'Apellidos', 'Correo de acceso', 'Correo secundario', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Empresa', 'Observaciones', 'Notificaciones'), // Nombre de los inputs del formulario
          $cliente, // Request
          array('nom', 'apell', 'email', 'email_secund', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'emp', 'obs', 'notif') // Nombre de los campos en la BD
        ); 
        $cliente->updated_at_us  = Auth::user()->email_registro;
      }
      if($request->hasfile('imagen')) {
        $imagen = ArchivoCargado::dispatch(
          $request->file('imagen'), 
          'perfil', // Ruta en la que guardara el archivo
          'perfil-'.time().'.', // Nombre del archivo
          $cliente->img_us
        ); 
        $cliente->img_us_rut  = $imagen[0]['ruta'];
        $cliente->img_us      = $imagen[0]['nombre'];
      }
      $cliente->save();
      $cliente->roles()->sync($request->rol);
      return $cliente;
    });
  }
  public function destroy($id_cliente) {
    try { DB::beginTransaction();
      $cliente = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2', []);
      $cliente->delete();
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Clientes', // Nombre del módulo del sistema
        'registro'    => $cliente->nom, // Información a mostrar en la papelera
        'tab'         => 'users', // Nombre de la tabla en la BD
        'id_reg'      => $cliente->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación            
      ]);
      DB::commit();
      return $cliente;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function reEnviarCorreoBienvenida($id_cliente) {
    try { DB::beginTransaction();
      $cliente = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2', []);
      if($cliente->email_verified_at != null) { // Si el usuario ya accedio una vez al sistema ya no dejara enviar correo de bienvenida
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
      $cliente->password = $this->serviceCrypt->bcrypt($nueva_password);
      $cliente->save();
      $plantilla = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_cli_bien'));
      $cliente->notify(new NotificacionBienvenidaCliente($cliente, $nueva_password, $plantilla)); // Envió de correo electrónico
      DB::commit();
      return false;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}
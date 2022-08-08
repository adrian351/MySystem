<?php
namespace App\Repositories\perfil\notificacion;
// Models
use App\User;
use App\Models\Notificacion;
// Events
use App\Events\sistema\notificacion\NotificacionEnviada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
use App\Repositories\servicio\fOpen\ServiceFopen;
// Otros
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
use DB;

class NotificacionRepositories implements NotificacionInterface {
  protected $serviceCrypt;
  protected $serviceFopen;
  public function __construct(ServiceCrypt $serviceCrypt, ServiceFopen $serviceFopen) {
    $this->serviceCrypt = $serviceCrypt;
    $this->serviceFopen = $serviceFopen;
  } 
  public function notificacionFindOrFail($id_notificacion) {
    // Devuelve la información de la notificación
    $id_notificacion = $this->serviceCrypt->decrypt($id_notificacion);
    $notificacion = Notificacion::findOrFail($id_notificacion);
    return $notificacion;
  }
  public function notificationFindOrFail($id_notification) {
    // Devuelve la información de la notificación
    $id_notification = $this->serviceCrypt->decrypt($id_notification);
    $marcar_como_leido = DatabaseNotification::where('notifiable_id', Auth::user()->id)->findOrFail($id_notification);
    $marcar_como_leido->markAsRead(); // Marca como leida la notificación
    return $marcar_como_leido;
  }
  public function getPagination($request) {
    if($request->opcion_buscador != null) {
      return Auth::user()->notifications()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->where('type', 'App\Notifications\notificacion\NotificacionSent')->orderBy('id', 'DESC')->paginate($request->paginador);
    } else {
      return Auth::user()->notifications()->orderBy('id', 'DESC')->where('type', 'App\Notifications\notificacion\NotificacionSent')->orderBy('id', 'DESC')->paginate($request->paginador);
    }
  }
  public function store($request) {
    DB::transaction(function() use($request) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $notificacion = new Notificacion();
      $notificacion->asunt            = $request->asunto;
      $notificacion->sender_id        = Auth::user()->id;
      $notificacion->dis_de_la_notif  = $request->diseno_de_la_notificacion;
      $notificacion->created_at_not   = Auth::user()->email_registro;
      $notificacion->save();
  
      // Define a que usuarios se enviara el correo
      if($request->todos_los_usuarios == 'on' AND $request->todos_los_clientes == 'on') {
        // Todos los registros
        $request->usuario = null;
        $usuarios = User::where('notif', 'on')->where('id', '!=', Auth::user()->id)->get();
      } else {
        if($request->todos_los_usuarios == 'on') {
          // Todos los usuarios
          $request->usuario = null;
          $usuarios = User::where('notif', 'on')->where('acceso', '1')->where('id', '!=', Auth::user()->id)->get();
        }
        if($request->todos_los_clientes == 'on') {
          // Todos los clientes
          $request->usuario = null;
          $usuarios = User::where('notif', 'on')->where('acceso', '2')->where('id', '!=', Auth::user()->id)->get();
        }
      }
      if($request->usuario != null) {
        // Solo los registros seleccionados (Select)
        $usuarisos = $request->usuario;
        $hasta = count($usuarisos) - 1;  
        for($contador1 = 0; $contador1 <= $hasta; $contador1++) {
          $usuarios[$contador1] = User::where('id', $usuarisos[$contador1])->first();
          if($usuarios[$contador1] == null) {
            unset($usuarios[$contador1]); // Emilina el valor del array si el valor en null
          }
        }
      }
      if(empty($usuarios)) { return abort(403, __('El/los usuarios seleccionados son inválidos')); }

      if(env('APP_ENV') == 'local') {
        $ruta = 'resources\views\diseno_notificacion\notificacion\\';
      } elseif(env('APP_ENV') == 'production') {
        $ruta= 'resources/views/diseno_notificacion/notificacion/';
      }
      $this->serviceFopen->fopen($ruta, $notificacion->id, $notificacion->dis_de_la_notif);

      NotificacionEnviada::dispatch($notificacion, $usuarios, auth()->user()->email_registro); // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      // Fin (Define a que usuarios se enviara el correo)
      return $notificacion;
    });
  }
  public function marcarComoVisto($request) {
    if(request()->ajax()) {
      $hasta1 = count($request->ids_seleccionados)-1;
      for($contador2 = 0; $contador2 <= $hasta1; $contador2++) {
        $marcar_como_leido = DatabaseNotification::where('notifiable_id', Auth::user()->id)->find($request->ids_seleccionados[$contador2]);
        if(empty($marcar_como_leido)) { return abort(404); } // Verifica si el registro existe en caso contrario aborta
        $marcar_como_leido->markAsRead(); // Marca como leida la notificación
      }
      return $marcar_como_leido;
    }
  }
  public function marcarComoNoVisto($request) {
    if(request()->ajax()) {
      $hasta1 = count($request->ids_seleccionados)-1;
      for($contador2 = 0; $contador2 <= $hasta1; $contador2++) {
        $marcar_como_no_leido = DatabaseNotification::where('notifiable_id', Auth::user()->id)->find($request->ids_seleccionados[$contador2]);
        if(empty($marcar_como_no_leido)) { return abort(404); } // Verifica si el registro existe en caso contrario aborta
        $marcar_como_no_leido->read_at = null; // Marca como no leida la notificación
        $marcar_como_no_leido->save();
      }
      return $marcar_como_no_leido;
    }
  }
}
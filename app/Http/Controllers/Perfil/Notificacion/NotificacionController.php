<?php
namespace App\Http\Controllers\Perfil\Notificacion;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\sistema\notificacion\StoreNotificacionRequest;
// Repositories
use App\Repositories\perfil\notificacion\NotificacionRepositories;
use App\Repositories\usuario\UsuarioRepositories;
// Servicios
use App\Repositories\servicio\fOpen\ServiceFopen;

class NotificacionController extends Controller {
  protected $serviceFopen;
  protected $notificacionRepo;
  protected $usuarioRepo;
  public function __construct(ServiceFopen $serviceFopen, NotificacionRepositories $notificacionRepositories, UsuarioRepositories $usuarioRepositories) { // Interfaz para implementar solo [metodos]
    $this->serviceFopen     = $serviceFopen;
    $this->notificacionRepo = $notificacionRepositories;
    $this->usuarioRepo      = $usuarioRepositories;
  }
  public function index(Request $request) {
    $notificaciones = $this->notificacionRepo->getPagination($request);
    return view('perfil.notificacion.per_not_index', compact('notificaciones'));    
  }
  public function create() {
    $usuarios = $this->usuarioRepo->getAllUsersPlunk();
    return view('sistema.notificacion.sis_not_create', compact('usuarios'));
  }
  public function store(StoreNotificacionRequest $request) {
    $this->notificacionRepo->store($request);
    toastr()->success('¡Notificación enviada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_notificacion, $id_notification) {
    $notificacion = $this->notificacionRepo->notificacionFindOrFail($id_notificacion);
    $this->notificacionRepo->notificationFindOrFail($id_notification);
    return view('perfil.notificacion.per_not_show', compact('notificacion'));
  }
  public function marcarComoVisto(Request $request) {
    $this->notificacionRepo->marcarComoVisto($request);
    return back();
  }
  public function marcarComoNoVisto(Request $request) {
    $this->notificacionRepo->marcarComoNoVisto($request);
    return back();
  }
  public function eliminarFicherosNotificacion() {
    $this->serviceFopen->eliminarFicherosBlade('resources\views\diseno_notificacion\notificacion\*'); 
    toastr()->success('¡Ficheros eliminados exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}
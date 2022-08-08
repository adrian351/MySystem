<?php
namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\usuario\ResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
// Models
use App\Models\Sistema;

class User extends Authenticatable implements JWTSubject{
  // Notifiable Permite implementar las notificaciones que se muestran en el sistema
  // HasRoles Permite implementar la capa de roles y permisos de laravel permissions
  // SoftDeletes Permite habilitar el campo deleted_at en la BD para no eliminar el registro directamente y trabajar sobre una papelera de reciclaje
  use Notifiable, HasRoles, SoftDeletes;
  use SoftCascadeTrait;
  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['actividades', 'quejasYSugerencias', 'cotizaciones', 'datosFiscales', 'direcciones', 'pedidos', 'facturas', 'pagos']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  protected $hidden = [
    'password', 'remember_token', 'created_at_us', 'updated_at_us',
  ];
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
  // Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro (on = todos los registros null = solo sus registros)
  public function scopeAsignado($query, $opcion_asignado, $usuario) {
    if($opcion_asignado == null) {
      return $query->where('asignado_us', $usuario);
    }
  }
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  // Sobre escribe el correo de restablecimiento de contraseña
  public function sendPasswordResetNotification($token) {
    $plantilla = \App\Repositories\sistema\plantilla\PlantillaRepositories::accesoModelPlantillaFindOrFailById(Sistema::datos()->sistemaFindOrFail()->plant_sis_rest_pass);
    $this->notify(new ResetPasswordNotification($token, $plantilla));
  }
  public function actividades(){
    return $this->hasMany('App\Models\Actividades')->orderBy('id', 'DESC');
  }
  public function quejasYSugerencias(){
    return $this->hasMany('App\Models\QuejaYSugerencia')->orderBy('id', 'DESC');
  }
  public function cotizaciones(){
    return $this->hasMany('App\Models\Cotizacion')->orderBy('id', 'DESC');
  }
  public function datosFiscales(){
    return $this->hasMany('App\Models\DatoFiscal')->orderBy('id', 'DESC');
  }
  public function direcciones(){
    return $this->hasMany('App\Models\Direccion')->orderBy('id', 'DESC');
  }
  public function pedidos(){
    return $this->hasMany('App\Models\Pedido')->orderBy('id', 'DESC');
  } 
  public function facturas(){
    return $this->hasMany('App\Models\Factura')->orderBy('id', 'DESC');
  }
  public function pagos(){
    return $this->hasMany('App\Models\Pago')->orderBy('id', 'DESC');
  }


  // implementacion de Jwt para autenticacion
  public function getJWTIdentifier()
  {
      return $this->getKey();
  }

  /**
   * Return a key value array, containing any custom claims to be added to the JWT.
   *
   * @return array
   */
  public function getJWTCustomClaims()
  {
      return [];
  }
}
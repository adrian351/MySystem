<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
// Repositories
use App\Repositories\sistema\sistema\SistemaRepositories;

class Sistema extends Model {
  use SoftDeletes; // Permite habilitar el campo deleted_at en la BD para no eliminar el registro directamente y trabajar sobre una papelera de reciclaje
  use SoftCascadeTrait;

  protected $table = 'sistema';
  protected $primaryKey = 'id';
  protected $sistemaRepo;
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  //  protected $softCascade = ['pedidos']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public static function datos() {
    return new SistemaRepositories; // Retorna la información del sistema
  }
  public static function dosDecimales($numero) {
    return number_format($numero, 2, '.', ',');
  }
  public static function tresDecimales($numero) {
    return number_format($numero, 3, '.', ',');
  }
}
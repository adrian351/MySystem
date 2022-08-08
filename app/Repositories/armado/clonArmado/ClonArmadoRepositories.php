<?php
namespace App\Repositories\armado\clonArmado;
// Repositories
use App\Repositories\armado\ArmadoRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ClonArmadoRepositories implements ClonArmadoInterface {
  protected $armadoRepo;
  public function __construct(ArmadoRepositories $armadoRepositories) {
    $this->armadoRepo        = $armadoRepositories;
  }
  public function store($id_armado) {
    try { DB::beginTransaction();
      $armado                  = $this->armadoRepo->armadoAsignadoFindOrFailById($id_armado, '0', 'productos');

    // SUMA MAS 1 AL NUMERO DE CLONES
      $armado->num_clon        += 1;
      $armado->save();

      // CLONA EL ARMADO
      $clon_armado                = $armado->replicate();
      $clon_armado->img_rut       = null;
      $clon_armado->img_nom       = null;
      $clon_armado->clon          = '1';
      $clon_armado->nom           .= ' - clon' .  $armado->num_clon;
      if ($clon_armado->sku == null | $clon_armado->sku == '') {
        $clon_armado->sku .= '-clon'.$armado->num_clon;
      }else{
        $clon_armado->sku   .= ' - clon' .  $armado->num_clon;
      }
     
      $clon_armado->asignado_arm  = Auth::user()->email_registro;
      $clon_armado->created_at_arm = Auth::user()->email_registro;
      $clon_armado->save();

      // CLONA LOS PRODUCTOS DEL ARMADO
      $datos = null;
      foreach($armado->productos as $producto_armado) {
        $datos[$producto_armado->id] = [
          'cant' => $producto_armado->pivot->cant,
        ];
      }
      $clon_armado->productos()->sync($datos);

      // $clon_armado->marca()->detach();
      // $clon_armado->marca()->attach();
      // sync()
      // ($request->marca);

      DB::commit();
      return $clon_armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}
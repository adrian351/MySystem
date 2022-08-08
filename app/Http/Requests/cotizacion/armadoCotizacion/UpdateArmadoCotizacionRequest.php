<?php
namespace App\Http\Requests\cotizacion\armadoCotizacion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateArmadoCotizacionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_armado = Crypt::decrypt($this->id_armado);
    $armado = \App\Models\CotizacionArmado::select('id_armado', 'cant_direc_carg', 'prec_redond', 'es_de_stock')->findOrFail($id_armado);
    $stock_armado = \App\Models\Armado::select('stock')->where('id', '=', $armado->id_armado)->get();

    if(is_numeric($this->cantidad)) {
      $max_desc = $this->cantidad * $armado->prec_redond;
    } else {
        $max_desc = 0;
      }
    
    if($armado->es_de_stock == 'Si'){
      $especificaciones = 'required|numeric|min:'.$armado->cant_direc_carg.'|max:'.$stock_armado[0]->stock.'';
    } else{
        $especificaciones = 'required|numeric|min:'.$armado->cant_direc_carg.'|max:99999';
      }
    return [
      'es_de_regalo'      => 'required|in:Si,No',
      'cantidad'          => $especificaciones,
      'tipo_de_descuento' => 'nullable|in:Sin descuento,Manual,Porcentaje',
      'manual'            => 'nullable|required_if:tipo_de_descuento,Manual|numeric|min:0|max:'.$max_desc.'|alpha_decimal15',
      'porcentaje'        => 'nullable|required_if:tipo_de_descuento,Porcentaje|in:.0,.01,.02,.03,.04,.05,.06,.07,.08,.09,.1,.11,.12,.13,.14,.15,.16,.17,.18,.19,.2,.21,.22,.23,.24,.25,.26,.27,.28,.29,.3,.31,.32,.33,.34,.35,.36,.37,.38,.39,.4,.41,.42,.43,.44,.45,.46,.47,.48,.49,.5,.51,.52,.53,.54,.55,.56,.57,.58,.59,.6,.61,.62,.63,.64,.65,.66,.67,.68,.69,.7,.71,.72,.73,.74,.75,.76,.77,.78,.79,.8,.81,.82,.83,.84,.85,.86,.87,.88,.89,.9,',
    ];
  }
}
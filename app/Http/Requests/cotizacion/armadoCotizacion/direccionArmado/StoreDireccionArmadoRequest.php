<?php
namespace App\Http\Requests\cotizacion\armadoCotizacion\direccionArmado;
use Illuminate\Foundation\Http\FormRequest;

class StoreDireccionArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_armado = $this->id_armado; // Este id se recibe desencriptado
    $armado = \App\Models\CotizacionArmado::select('cant', 'cant_direc_carg')->findOrFail($id_armado);
    $dir_permitidas = $armado->cant - $armado->cant_direc_carg;
    return [
    /*
    * SOLO HACE LA VALIDACION REQUIRED DE ESTOS CAMPOS PARA OBLIGAR AL USUARIO A SELECCIONAR UN 
    * COSTO DE ENVIO YA QUE DICHA VALIDACION DE ESTOS CAMPOS SE HACE DESDE EL MODULO COSTOS DE ENVIO
    */
      'costo_seleccionado'        => 'required',
      'cantidad'                  => 'required|numeric|min:0|max:'.$dir_permitidas,
      // 'detalles_de_la_ubicacion'  => 'required|max:150',
      
    ];
  }
  public function messages() {
    return [
      // Mensaje que se muestra en las diferentes validaciones, por ejemplo "required, max: min: ...".
       'costo_seleccionado.required' => 'No se ha seleccionado ningún :attribute',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'costo_seleccionado'    => 'costo de envío',
    ];
  }
}
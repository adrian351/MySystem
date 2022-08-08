<?php
namespace App\Http\Requests\costoDeEnvio;
use Illuminate\Foundation\Http\FormRequest;
// Otros
use Illuminate\Support\Facades\Crypt;

class UpdateCostoDeEnvioRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'registro'                      => 'required|unique:costos_de_envio,registr,' . $this->id_costo,
      'foraneo_o_local'               => 'required|in:Foráneo,Local',
      'metodo_de_entrega'             => 'required|exists:metodos_de_entrega,nom_met_ent',
      'metodo_de_entrega_especifico'  => 'nullable|required_if:metodo_de_entrega,Paquetería',
      'cantidad'                      => 'nullable|required_if:metodo_de_entrega_especifico,TresGuerras|max:10',
      'transporte'                    => 'nullable|required_if:metodo_de_entrega,Transportes Ferro',
      'estado'                        => 'required|exists:estados,est',
      'total_o_unitario'              => 'nullable|required_if:foraneo_o_local,Local|in:Unitario,Total',
      'municipio'                     => 'nullable|max:150',
      'tipo_de_envio'                 => 'required_with:tipos_de_envio|nullable|exists:tipos_de_envio,tip_de_env',
      'tamano'                        => 'required|in:Chico,Mediano,Grande',
      'aplicar_costo_de_caja'         => 'nullable|in:Si,No',
      'cuenta_con_seguro'             => 'required|in:Si,No',
      'tiempo_de_entrega'             => 'required|max:25',
      'costo_por_envio'               => 'required|min:0|numeric|alpha_decimal15',
    ];
  }
  public function messages() {
    return [
       'registro.unique' => 'La información introducida ya existe en otro registro.',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'tamano'    => 'tamaño',
    ];
  }
}
<?php
namespace App\Http\Requests\logistica\direccionLocal;
use Illuminate\Foundation\Http\FormRequest;

class UpdateComprobanteDeSalidaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $comprobante = \App\Models\PedidoArmadoDireccionTieneComprobante::select('direccion_id', 'cant')->findOrFail($this->id_comprobante);
    $direccion = \App\Models\PedidoArmadoTieneDireccion::with('comprobantes')->findOrFail($comprobante->direccion_id);
    $cant_comprobantes = $direccion->comprobantes()->sum('cant');
    $cargados = $cant_comprobantes - $comprobante->cant;
    $max = $direccion->cant - $cargados;

    return [
      'cantidad'                      => 'required|numeric|min:1|max:'.$max,
      'metodo_de_entrega'             => 'required|exists:metodos_de_entrega,nom_met_ent',
      'metodo_de_entrega_especifico'  => 'required_if:metodo_de_entrega,Paquetería,Transporte interno de la empresa,Transportes Ferro,Viaje metropolitano (Uber, Didi, Beat...)',
      'comprobante_de_salida'         => 'nullable|mimes:pdf,jpg,jpeg,png,xlsx|max:10240'
    ];
  }
}
<?php
namespace App\Http\Requests\logistica\direccionLocal;
use Illuminate\Foundation\Http\FormRequest;

class StoreComprobanteDeSalidaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'costo_por_envio'               => 'nullable|min:0|numeric|alpha_decimal18',
      'metodo_de_entrega'             => 'required|exists:metodos_de_entrega,nom_met_ent',
      'metodo_de_entrega_especifico'  => 'required_if:metodo_de_entrega,Paquetería,Transporte interno de la empresa,Transportes Ferro,Viaje metropolitano (Uber, Didi, Beat...)',
      // 'comprobante_de_salida'         => 'required_without:comprobante_de_salida_nom|nullable|image'
      'comprobante_de_salida'  => 'required|mimes:pdf,jpg,jpeg,png,xlsx|max:10240',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'comprobante_de_salida_nom'    => 'comprobante de salida',
    ];
  }
}
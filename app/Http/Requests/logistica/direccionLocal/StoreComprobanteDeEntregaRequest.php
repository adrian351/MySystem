<?php
namespace App\Http\Requests\logistica\direccionLocal;
use Illuminate\Foundation\Http\FormRequest;

class StoreComprobanteDeEntregaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    if($this->metodo_de_entrega == 'Transportes Ferro') {
      // |nullable|exists:metodos_de_entrega_especificos,nom_met_ent_esp
      return [
        'metodo_de_entrega_especifico'  => 'required_if:metodo_de_entrega,Transportes Ferro',
        'paqueteria'                    => 'required_if:metodo_de_entrega_especifico,Paquetería',
        'numero_de_guia'                => 'required_if:metodo_de_entrega_especifico,Paquetería|max:60',
        // 'comprobante_de_entrega'        => 'required|image',
        'comprobante_de_entrega'  => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
      ];
    }else {
      return [
        'numero_de_guia'          => 'required_if:metodo_de_entrega,Paquetería|max:60',
        // 'comprobante_de_entrega'  => 'required|image',
        'comprobante_de_entrega'  => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
      ];
    }
  }
}
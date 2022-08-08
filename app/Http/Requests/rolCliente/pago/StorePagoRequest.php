<?php
namespace App\Http\Requests\rolCliente\pago;
use Illuminate\Foundation\Http\FormRequest;

class StorePagoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    if($this->numero_de_pedido != null) {
      $id_pedido = $this->numero_de_pedido;
      $pedido = \App\Models\Pedido::select('id', 'mont_tot_de_ped')->with('pagos')->findOrFail($id_pedido);
      $sum_mont_de_pag = $pedido->pagos()->sum('mont_de_pag');
      $max_monto = $pedido->mont_tot_de_ped - $sum_mont_de_pag;
    }else {
      $max_monto = -1;
    }
    return [
      'numero_de_pedido'                    => 'required|exists:pedidos,id',
      'comprobante_de_pago'                 => 'required|mimes:pdf,jpg,jpeg,png|max:1024',
    //  'ultimos_8_digitos_del_folio_de_pago' => 'nullable|required_if:forma_de_pago,Cheque,Paypal,Tarjeta de credito (Pagina),Tarjeta de credito (Clip),Tarjeta de debito,Transferencia RUTH Yolanda,Transferencia Canastas y Arcones S.A de C.V|unique:pagos,fol|min:8|max:8',
    'ultimos_8_digitos_del_folio_de_pago' => 'nullable|unique:pagos,fol|nullable|min:8|max:8',
      'forma_de_pago'                       => 'required|in:Cheque,Efectivo (Jonathan),Efectivo (Gabriel),Efectivo (Fernando),Efectivo (Mestras/Garantías),Paypal,Tarjeta de credito (Pagina),Tarjeta de credito (Clip),Tarjeta de credito (Conekta),Tarjeta de credito (Openpay),Tarjeta de debito,Transferencia RUTH Yolanda,Transferencia Canastas y Arcones S.A de C.V,Otro',
      'copia_de_identificacion'             => 'required_if:forma_de_pago,Paypal,Tarjeta de credito (Pagina)|nullable|mimes:pdf,jpg,jpeg,png|max:1024',
      'monto_del_pago'                      => 'required|numeric|min:0|max:'.$max_monto.'|alpha_decimal15',
    ];
  }
}
<?php
namespace App\Http\Requests\pago\fPedido;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pago;
use Illuminate\Support\Facades\Crypt;

class UpdatePagoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_pago = Crypt::decrypt($this->id_pago);
    $pago = Pago::with('pedido')->findOrFail($id_pago);
    $sum_mont_de_pag = Pago::where('pedido_id', $pago->pedido_id)->sum('mont_de_pag');
    $sum_mont_de_pag = ($sum_mont_de_pag - $pago->mont_de_pag);
    $max_monto = $pago->pedido->mont_tot_de_ped - $sum_mont_de_pag;

    if( $pago->comp_de_pag_nom == null) {
      $validacion = 'required|mimes:pdf,jpg,jpeg,png|max:1024';
    } else {
      $validacion = 'nullable|mimes:pdf,jpg,jpeg,png|max:1024';
    }

    if($pago->cop_de_indent_nom == null) {
      $validacion2 = 'nullable|required_if:forma_de_pago,Paypal,Tarjeta de credito (Pagina)|mimes:pdf,jpg,jpeg,png|max:1024';
    } else {
      $validacion2 = 'nullable|mimes:pdf,jpg,jpeg,png|max:1024';
    }

    return [
    //  'estatus_pago'            => 'required|in:Pendiente',
      'comprobante_de_pago'     => $validacion,
      'forma_de_pago'           => 'required|in:Cheque,Efectivo (Jonathan),Efectivo (Gabriel),Efectivo (Fernando),Efectivo (Muestras/Garantías),Paypal,Tarjeta de credito (Pagina),Tarjeta de credito (Clip),Tarjeta de credito (Conekta),Tarjeta de credito (Openpay),Tarjeta de debito,Transferencia RUTH Yolanda,Transferencia Canastas y Arcones S.A de C.V,Otro',
      'copia_de_identificacion' => $validacion2,
      'monto_del_pago'          => 'required|numeric|min:0|max:'.$max_monto.'|alpha_decimal15',
      'comentarios_ventas'      => 'nullable|max:30000|string',
    ];
  }
}
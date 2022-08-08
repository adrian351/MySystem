<?php
namespace App\Http\Requests\pago\individual;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StorePagoCodigoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_pedido = Crypt::decrypt($this->id_pedido);
    $pedido = \App\Models\Pedido::select('id', 'mont_tot_de_ped')->with('pagos')->findOrFail($id_pedido);
    $sum_mont_de_pag = $pedido->pagos()->sum('mont_de_pag');
    $max_monto = $pedido->mont_tot_de_ped - $sum_mont_de_pag;
    return [
      'monto_del_pago'          => 'required|numeric|min:0|max:'.$max_monto.'|alpha_decimal15',
      'comentarios_ventas'      => 'nullable|max:30000|string',
    ];
  }
}
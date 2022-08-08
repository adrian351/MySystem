<?php
namespace App\Http\Requests\sistema\plantilla;
use Illuminate\Foundation\Http\FormRequest;

class StorePlantillaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'nombre_de_la_plantilla'	=> 'required|max:100|unique:plantillas,nom',
      'modulo'                  => 'required|in:'.
                                                  config('opcionesSelect.select_modulo.Cotizaciones (Términos y condiciones)').','.
                                                  config('opcionesSelect.select_modulo.Clientes (Bienvenida)').','.
                                                  config('opcionesSelect.select_modulo.Facturación (Factura generada)').','.
                                                  config('opcionesSelect.select_modulo.Facturación (Factura cancelada)').','.
                                                  config('opcionesSelect.select_modulo.Logística (Pedido entregado)').','.
                                                  config('opcionesSelect.select_modulo.Facturación (Error del cliente)').','.
                                                  config('opcionesSelect.select_modulo.Pagos (Registrar pago)').','.
                                                  config('opcionesSelect.select_modulo.Pagos (Pago rechazado)').','.
                                                  config('opcionesSelect.select_modulo.Perfil (Cambio de contraseña)').','.
                                                  config('opcionesSelect.select_modulo.Sistema (Restablecimiento de contraseña)').','.
                                                  config('opcionesSelect.select_modulo.Usuarios (Bienvenida)').','.
                                                  config('opcionesSelect.select_modulo.Ventas (Registrar pedido)').','.
                                                  config('opcionesSelect.select_modulo.Ventas (Pedido cancelado)'),
      'asunto'                  => 'required|max:100',
    ];
  }
}
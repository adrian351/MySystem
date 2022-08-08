<?php
namespace App\Http\Requests\factura;
use Illuminate\Foundation\Http\FormRequest;

class StoreFacturaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'cliente'                 => 'required|exists:users,id',
      
      'checkbox_datos_fiscales' => 'in:on,off', 
      'nombre_o_razon_social'   => 'required|max:60',
      'rfc'                     => 'required|min:12|max:20',
      'lada_telefono_fijo'      => 'nullable|max:9999|min:1|numeric|required_with:telefono_fijo',
      'telefono_fijo'           => 'nullable|max:15|alpha_solo_numeros_guiones|required_with:lada_telefono_fijo',
      'extension'               => 'max:10',
      'lada_telefono_movil'     => 'nullable|max:9999|min:1|numeric',
      'telefono_movil'          => 'required|max:15|alpha_solo_numeros_guiones',
      'calle'                   => 'required|max:45',
      'no_exterior'             => 'required|max:8',
      'no_interior'             => 'nullable|max:30',
      'pais'                    => 'required|max:40',
      'ciudad'                  => 'required|max:50',
      'colonia'                 => 'required|max:40',
      'delegacion_o_municipio'  => 'required|max:50',
      'codigo_postal'           => 'required|max:6',
      'correo'                  => 'required|max:75|email',

      'codigo_de_facturacion'               => 'required|exists:pagos,cod_fact|alpha_codigo_de_facturacion_pertenece_al_usuario:'. $this->cliente.'|alpha_cierre_fiscal|alpha_con_o_sin_iva|alpha_estatus_codigo_de_facturacion|alpha_solo_facturar_si_ya_esta_pagado',
      'uso_de_cfdi'                         => 'required|in:'.
                                                              config('opcionesSelect.select_uso_de_cfdi.G01 Adquisición de mercancias').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.G02 Devoluciones descuentos o bonificaciones').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.G03 Gastos en general').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.P01 Por definir').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.I01 Construcciones').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.I02 Mobiliario y equipo de oficina por inversiones').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.I03 Equipo de transporte').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.I04 Equipo de computo y accesorios').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.I05 Dados troqueles moldes matrices y herramientas').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.I06 Comunicaciones telefonicas').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.I07 Comunicaciones satelitales').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.I08 Otra maquinaria y equipo').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.D01 honorarios médicos dentales y gastos hospitalarios').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.D02 Gastos médicos por incapacidad o discapacidad').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.D03 Gastos funerales').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.D04 Donativos').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.D05 Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación)').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.D06 Aportaciones voluntarias al SAR').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.D07 Primas por seguros de gastos médicos').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.D08 Gastos de transportación escolar obligatoria').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.D09 Depósitos en cuentas para el ahorro primas que tengan como base planes de pensiones').','.
                                                              config('opcionesSelect.select_uso_de_cfdi.D10 Pagos por servicios educativos (colegiaturas)'),
      'metodo_de_pago'                      => 'required|in:'.
                                                              config('opcionesSelect.select_metodo_de_pago.PUE Pago en una sola exhibición').','.
                                                              config('opcionesSelect.select_metodo_de_pago.PPD Pago en parcialidades o diferido'),
      'forma_de_pago'                       => 'required|in:'.
                                                              config('opcionesSelect.select_forma_de_pago_factura.01 Efectivo').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.02 Cheque nominativo').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.03 Transferencia electrónica de fondos').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.04 Tarjeta de crédito').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.05 Monedero electrónico').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.06 Dinero electrónico').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.08 Vales de despensa').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.12 Dación en pago').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.13 Pago por subrogación').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.14 Pago por consignación').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.15 Condonación').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.17 Compensación').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.23 Novación').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.24 Confusión').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.25 Remisión de deuda').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.26 Prescripción o caducidad').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.27 A satisfacción del acreedor').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.28 Tarjeta de débito').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.29 Tarjeta de servicios').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.30 Aplicación de anticipos').','.
                                                              config('opcionesSelect.select_forma_de_pago_factura.99 Por definir'),
      'banco_de_cuenta_de_retiro'           => 'max:50|required_with:ultimos_4_digitos_cuenta_de_retiro',
      'ultimos_4_digitos_cuenta_de_retiro'  => 'nullable|required_with:banco_de_cuenta_de_retiro|max:4|alpha_solo_numeros',
      'concepto'                            => 'required|in:'.config('opcionesSelect.select_concepto.Arcón Navideño').','.config('opcionesSelect.select_concepto.Canastas Navideñas').','.config('opcionesSelect.select_concepto.Despensas').','.config('opcionesSelect.select_concepto.Regalo de fin de año'),
      'comentarios_cliente'                 => 'nullable|max:30000|string',
    ];
  }
}
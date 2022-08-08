<div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="created_at">{{ __('Fecha de registro') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
        </div>
        {!! Form::text('created_at', $pago->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    @include('pago.pag_showFields.numeroDePedido')
    @include('factura.fac_showFields.estatusFactura', ['factura' => $pago])
  </div>
  <div class="row">
    @include('pago.pag_showFields.codigoDeFacturacion')
    @include('pago.pag_showFields.estatusPago')
  </div>
  <div class="row">
    @include('pago.pag_showFields.formaDePago')
    @include('pago.pag_showFields.montoDePago')
  </div>
  @include('pago.pag_showFields.comentarios')
  @include('pago.pag_showFields.archivos_comPago_copIdentificacion')
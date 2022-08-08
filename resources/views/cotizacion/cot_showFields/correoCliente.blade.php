<div class="form-group col-sm btn-sm">
  <label for="correo_del_cliente">{{ __('Correo del cliente') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
    </div>
    {!! Form::text('correo_del_cliente', $cotizacion->cliente->email_registro, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Correo del cliente'), 'readonly' => 'readonly']) !!}
  </div>
</div>
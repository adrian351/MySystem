<div class="form-group col-sm btn-sm">
  <label for="fecha_en_la_que_se_facturo">{{ __('Fecha en la que se facturo') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
    </div>
    {!! Form::text('fecha_en_la_que_se_facturo', $factura->fech_facturado, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Fecha en la que se facturo'), 'readonly' => 'readonly']) !!}
  </div>
</div>
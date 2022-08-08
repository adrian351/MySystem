<div class="form-group col-sm btn-sm">
  <label for="fecha_de_entrega">{{ __('Fecha de entrega') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-calendar-alt"></i></i></span>
    </div>
    {!! Form::text('fecha_de_entrega', $pedido->fech_de_entreg, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Fecha de entrega'), 'readonly' => 'readonly']) !!}
  </div>
</div>
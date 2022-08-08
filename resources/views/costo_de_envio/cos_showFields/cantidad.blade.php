<div class="form-group col-sm btn-sm">
  <label for="cantidad">{{ __('Cantidad') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
    </div>
    {!! Form::text('cantidad', $costo_de_envio->cant, ['id' => 'cantidad', 'class' => 'form-control disabled', 'placeholder' => __('Cantidad'), 'readonly' => 'readonly']) !!}
  </div>
</div>
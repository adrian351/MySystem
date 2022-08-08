<div class="form-group col-sm btn-sm">
  <label for="metodo_de_entrega">{{ __('Método de entrega') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-list"></i></span>
    </div>
    {!! Form::text('metodo_de_entrega', $costo_de_envio->met_de_entreg, ['class' => 'form-control', 'placeholder' => __('Método de entrega'), 'readonly' => 'readonly']) !!}
  </div>
</div>
<div class="form-group col-sm btn-sm">
    <label for="es_de_stock">{{ __('¿Es de stock?') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::text('es_de_stock', $armado->es_de_stock, ['class' => 'form-control select disabled', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
    </div>
  </div>
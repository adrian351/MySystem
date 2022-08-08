<div class="form-group col-sm btn-sm">
  <label for="nombre">{{ __('Nombre') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-shopping-basket"></i></span>
    </div>
      {!! Form::text('nombre', $armado->nom, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Nombre'), 'readonly' => 'readonly']) !!}
  </div>
</div>
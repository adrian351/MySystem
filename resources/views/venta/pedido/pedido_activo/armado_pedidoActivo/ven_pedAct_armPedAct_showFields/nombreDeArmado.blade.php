<div class="form-group col-sm btn-sm">
  <label for="nombre_de_armado">{{ __('Nombre de armado') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-shopping-basket"></i></span>
    </div>
    {!! Form::text('nombre_de_armado', $armado->nom, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Nombre de armado'), 'readonly' => 'readonly']) !!}
  </div>
</div>
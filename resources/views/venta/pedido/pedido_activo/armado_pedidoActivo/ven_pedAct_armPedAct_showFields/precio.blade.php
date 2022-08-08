<div class="form-group col-sm btn-sm">
  <label for="precio">{{ __('Precio') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('precio', $armado->prec, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Precio'), 'readonly' => 'readonly']) !!}
  </div>
</div>
<div class="form-group col-sm btn-sm">
  <label for="estado">{{ __('Estado') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-list"></i></span>
    </div>
    {!! Form::text('estado', $costo_de_envio->est, ['class' => 'form-control', 'placeholder' => __('Estado'), 'readonly' => 'readonly']) !!}
  </div>
</div>
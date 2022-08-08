<div class="form-group col-sm btn-sm">
  <label for="id">{{ __('#') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
     {!! Form::text('id', $costo_de_envio->id, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('#'), 'readonly' => 'readonly']) !!}
  </div>
</div>
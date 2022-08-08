<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentarios_administrador">{{ __('Comentarios administrador') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width "></i></span>
      </div>
      {!! Form::textarea('comentarios_administrador', $factura->coment_admin, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Comentarios administrador'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
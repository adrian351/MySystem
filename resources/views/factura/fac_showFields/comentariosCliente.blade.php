<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentarios_cliente">{{ __('Comentarios cliente') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width "></i></span>
      </div>
      {!! Form::textarea('comentarios_cliente', $factura->coment_u_obs_us, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Comentarios cliente'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
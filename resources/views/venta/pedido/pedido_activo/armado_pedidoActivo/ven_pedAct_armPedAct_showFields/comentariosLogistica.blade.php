@if ($armado->coment_log != null)
<div class="form-group col-sm btn-sm">
  <label for="comentarios_logistica">{{ __('Comentarios logística') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::textarea('comentarios_logistica', $armado->coment_log, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Comentarios logística'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
  </div>
</div>
@endif
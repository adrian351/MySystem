
@if ($armado->coment_produc != null)
<div class="form-group col-sm btn-sm">
  <label for="comentarios_produccion">{{ __('Comentarios producción') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::textarea('comentarios_produccion', $armado->coment_produc, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Comentarios producción'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
  </div>
</div>
@endif
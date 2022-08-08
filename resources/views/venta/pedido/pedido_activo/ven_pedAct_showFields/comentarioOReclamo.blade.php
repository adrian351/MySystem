@if ($pedido->coment_o_reclam != null )
<div class="form-group col-sm btn-sm">
  <label for="comentario_o_reclamacion">{{ __('Comentario o reclamación') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::textarea('comentario_o_reclamacion', $pedido->coment_o_reclam, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Comentario o reclamación'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
  </div>
</div>
@endif
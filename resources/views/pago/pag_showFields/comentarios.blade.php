@if($pago->coment_pag != null)
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentarios">{{ __('Comentarios pago') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentarios', $pago->coment_pag, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Comentarios pago'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
@endif
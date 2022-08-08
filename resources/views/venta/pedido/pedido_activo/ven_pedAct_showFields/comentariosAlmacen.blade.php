@if ($pedido->coment_alm != null)
  <div class="form-group col-sm btn-sm">
    <label for="comentarios_almacen">{{ __('Comentarios almacén') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentarios_almacen', $pedido->coment_alm, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Comentarios almacén'),'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
@endif

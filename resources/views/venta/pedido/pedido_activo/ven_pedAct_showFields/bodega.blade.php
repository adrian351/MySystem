<div class="form-group col-sm btn-sm">
    <label for="bodega_donde_se_armara">{{ __('Bodega donde se armara') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('bodega_donde_se_armara', $pedido->bod, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Bodega donde se armara'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
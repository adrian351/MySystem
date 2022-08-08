@if ($pedido->cuant_dia_ant != null)
  <div class="form-group col-sm btn-sm">
    <label for="cuantos_dias_antes">{{ __('¿Cuántos días antes?') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-question"></i></span>
      </div>
      {!! Form::text('cuantos_dias_antes', $pedido->cuant_dia_ant, ['class' => 'form-control disable',  'maxlength' => 0, 'placeholder' => __('¿Cuántos días antes?'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
@endif
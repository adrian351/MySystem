<div class="form-group col-sm btn-sm">
  <label for="usuario_que_autorizo_el_pago">{{ __('Usuario que autorizo el pago') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
      {!! Form::text('usuario_que_autorizo_el_pago', $pago->user_aut, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Usuario que autorizo el pago'), 'readonly' => 'readonly']) !!}
  </div>
</div>
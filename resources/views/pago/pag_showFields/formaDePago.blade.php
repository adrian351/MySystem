<div class="form-group col-sm btn-sm">
  <label for="forma_de_pago">{{ __('Forma de pago') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('forma_de_pago', $pago->form_de_pag, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Forma de pago'), 'readonly' => 'readonly']) !!}
  </div>
</div>
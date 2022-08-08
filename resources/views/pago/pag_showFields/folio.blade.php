<div class="form-group col-sm btn-sm">
  <label for="ultimos_8_digitos_del_folio_de_pago">{{ __('Últimos 8 dígitos del folio de pago') }} *</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('ultimos_8_digitos_del_folio_de_pago', $pago->fol, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Últimos 8 dígitos del folio de pago'), 'readonly' => 'readonly']) !!}
  </div>
</div>
<div class="form-group col-sm btn-sm">
  <label for="cuenta_con_seguro">{{ __('Cuenta con seguro') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-list"></i></span>
    </div>
    {!! Form::select('cuenta_con_seguro', config('opcionesSelect.select_si_no'), $costo_de_envio->seg, ['class' => 'form-control select2', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
  </div>
</div>
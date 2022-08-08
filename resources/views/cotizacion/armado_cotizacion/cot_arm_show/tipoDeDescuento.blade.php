<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descuento">{{ __('Tipo de descuento') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo_de_descuento', config('opcionesSelect.select_tipo_de_descuento'), $armado->tip_desc, ['id' => 'tipo_de_descuento', 'class' => 'form-control select2 disabled', 'placeholder' => __(''), 'readonly' => 'readonly', 'onChange' => 'getTipoDeEnvio();']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm" id="opc_manual">
    <label for="manual">{{ __('Manual') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('manual', $armado->manu, ['id' => 'manual', 'class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Manual'), 'readonly' => 'readonly', 'onChange' => 'getManualDecimal();']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
  </div>
  <div class="form-group col-sm btn-sm" id="opc_porcentaje">
    <label for="porcentaje">{{ __('Porcenjate') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-percentage"></i></span>
      </div>
      {!! Form::select('porcentaje', config('opcionesSelect.select_utilidad_sin_seleccione'), $armado->porc, ['id' => 'porcentaje', 'class' => 'form-control select2 disabled', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="descuento">{{ __('Descuento') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('descuento', Sistema::dosDecimales($armado->desc), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Descuento'), 'readonly' => 'readonly']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
  </div>
</div>
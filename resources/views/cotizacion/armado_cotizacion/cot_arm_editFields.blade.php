{{--  @include('armado.arm_showFields.medidas')  --}}
<div class="row">
  @include('armado.arm_showFields.tipo')
  @include('cotizacion.armado_cotizacion.cot_arm_show.descripcion')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="es_de_regalo">{{ __('¿Es de regalo?') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('es_de_regalo', config('opcionesSelect.select_si_no'), $armado->es_de_regalo, ['class' => 'form-control select2' . ($errors->has('es_de_regalo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('es_de_regalo') }}</span>
  </div>
  @include('cotizacion.armado_cotizacion.cot_arm_show.es_de_stock')
</div>
<div class="row">
  @include('armado.arm_showFields.precioDeCompra')
  @include('armado.arm_showFields.descuentoEspecial')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad">{{ __('Cantidad') }} *</label>
    @if($armado->es_de_stock == 'Si')
      <span class="float-right">
        <h6>
          
          {{ __('Armados disponibles') }}
          @php
            $stock = $stock_armado->stock - $armado->cant;
          @endphp
          <span class="badge badge-info">{{ $stock }}</span>
        </h6>
      </span>
    @endif
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('cantidad', $armado->cant, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'id' => 'cantidadArmado', 'maxlength' => 5, 'placeholder' => __('Cantidad')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('cantidad') }}</span>
  </div>
  @include('cotizacion.armado_cotizacion.cot_arm_show.precio_unitario')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descuento">{{ __('Tipo de descuento') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo_de_descuento', config('opcionesSelect.select_tipo_de_descuento'), $armado->tip_desc, ['id' => 'tipo_de_descuento', 'class' => 'form-control select2' . ($errors->has('tipo_de_descuento') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'getTipoDeEnvio();']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo_de_descuento') }}</span>
  </div>
  <div class="form-group col-sm btn-sm" id="opc_manual">
    <label for="manual">{{ __('Manual') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('manual', $armado->manu, ['id' => 'manual', 'class' => 'form-control' . ($errors->has('manual') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Manual'), 'onChange' => 'getManualDecimal();']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('manual') }}</span>
  </div>
  <div class="form-group col-sm btn-sm" id="opc_porcentaje">
    <label for="porcentaje">{{ __('Porcenjate') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-percentage"></i></span>
      </div>
      {!! Form::select('porcentaje', config('opcionesSelect.select_utilidad_sin_seleccione'), $armado->porc, ['id' => 'porcentaje', 'class' => 'form-control select2' . ($errors->has('porcentaje') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('porcentaje') }}</span>
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
<div class="row">
  @include('cotizacion.armado_cotizacion.cot_arm_show.costo_de_envio')
</div>
<div class="row">
  @include('cotizacion.armado_cotizacion.cot_arm_show.subtotal')
  @include('cotizacion.armado_cotizacion.cot_arm_show.iva')
  @include('cotizacion.armado_cotizacion.cot_arm_show.total')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('cotizacion.edit', Crypt::encrypt($armado->cotizacion->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Continuar con la cotización') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'cotizacionArmadoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar armado') }}</button>
  </div>
</div>
@include('cotizacion.armado_cotizacion.getTipoDeEnvio')
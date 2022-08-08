
<div class="row" id="div_comentarios">
  <div class="form-group col-sm btn-sm">
    <label for="comentarios">{{ __('Comentarios') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentarios', $pago->coment_pag, ['class' => 'form-control' . ($errors->has('comentarios') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentarios'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentarios') }}</span>
  </div>
</div>
<br>
<div class="row border">
  <div class="form-group col-sm btn-sm ">
    <label for="checkbox_correo"></label>
    <div class="input-group p-2">
      <div class="custom-control custom-switch">
        {!! Form::checkbox('checkbox_correo', 'on', true, ['id' => 'checkbox_correo', 'class' => 'custom-control-input' . ($errors->has('checkbox_correo') ? ' is-invalid' : '')]) !!}
        <label class="custom-control-label" for="checkbox_correo">{{ __('Enviar correo') }}</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('checkbox_correo') }}</span>
  </div>
</div>
@include('pago.pag_showFields.archivos_comPago_copIdentificacion')

<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="estatus_pago">{{ __('Estatus pago:') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('estatus_pago', config('opcionesSelect.select_estatus_pago_individual'), $pago->estat_pag, ['id' => 'estatus_pago', 'class' => 'form-control select2' . ($errors->has('estatus_pago') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'getEstatusPago();']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('estatus_pago') }}</span>
  </div>
</div>

<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('pago.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'pagoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>

@include('layouts.private.plugins.priv_plu_select2')
@section('js5')
<script>
  window.onload = function() { 
    getEstatusPago();
  }
  function getEstatusPago() {
    selectEstatusPago = document.getElementById("estatus_pago"),
    estatus_pago      = selectEstatusPago.value;
    div_comentarios   = document.getElementById('div_comentarios');

    if(estatus_pago == 'Rechazado') {
      div_comentarios.style.display = 'block';
    } else {
      div_comentarios.style.display = 'none';
    }
  }
</script>
@endsection
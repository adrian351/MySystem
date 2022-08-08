<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="estatus">{{ __('Estatus') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('estatus', config('opcionesSelect.select_estatus_armado_produccion'), $armado->estat, ['id' => 'estatus', 'class' => 'form-control select2' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'getEstatRack();']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('estatus') }}</span>
  </div>
  <div class="form-group col-sm btn-sm" id="ubicacion-rack">
    <label for="ubicacion_rack">{{ __('Ubicación rack') }} * </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('ubicacion_rack', $armado->ubic_rack	, ['class' => 'form-control' . ($errors->has('ubicacion_rack') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Ubicación rack')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('ubicacion_rack') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentario_produccion">{{ __('Comentario producción') }} </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentario_produccion', $armado->coment_produc, ['class' => 'form-control' . ($errors->has('comentario_produccion') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentario producción'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentario_produccion') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('produccion.pedidoActivo.edit', Crypt::encrypt($armado->pedido->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Continuar con el pedido') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'produccionPedidoActivoArmadoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar armado') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')

@section('js5')
<script>
  window.onload = function() { //se ejecuta cuando se abre la pág o recargue
    getEstatRack();
  }
  function getEstatRack() {
    SelectEstatus = document.getElementById("estatus"),
    estatus = SelectEstatus.value;
    ubicacion_rack = document.getElementById('ubicacion-rack');
    if(estatus == "{{ config('app.en_almacen_de_salida') }}"){
      ubicacion_rack.style.display = 'block';
    } else if (estatus == "{{ config('app.en_produccion') }}" || estatus == "{{ config('app.en_revision_de_productos') }}" || estatus == ''){
      ubicacion_rack.style.display = 'none';
    }
  }
</script>
@endsection
<div class="row">
  {{--  campo: lider de padido deshabilitado  --}}
  {{--  <div class="form-group col-sm btn-sm">
    <label for="lider_de_pedido_produccion">{{ __('Líder de pedido producción') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('lider_de_pedido_produccion', $pedido->lid_de_ped_produc, ['class' => 'form-control' . ($errors->has('lider_de_pedido_produccion') ? ' is-invalid' : ''), 'maxlength' => 80, 'placeholder' => __('Líder de pedido producción')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('lider_de_pedido_produccion') }}</span>
  </div>  --}}

  
  {{-- asignar bodega de produccion por defecto --}}
    <div class="form-group col-sm btn-sm">
      <label for="bodega_donde_se_armara">{{ __('Bodega donde se armara') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::select('bodega_donde_se_armara', config('opcionesSelect.select_bodega_donde_se_armara'), $pedido->bod, ['class' => 'form-control select2' . ($errors->has('bodega_donde_se_armara') ? ' is-invalid' : '')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('bodega_donde_se_armara') }}</span>
    </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentario_produccion">{{ __('Comentario producción') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentario_produccion', $pedido->coment_produc, ['class' => 'form-control' . ($errors->has('comentario_produccion') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentario producción'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentario_produccion') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('produccion.pedidoActivo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'produccionPedidoActivoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar pedido') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
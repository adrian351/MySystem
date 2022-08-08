<td width="1rem" title="Editar: {{ $armado->id }}">
  @if($armado->estat == config('app.en_almacen_de_salida') OR $armado->estat == config('app.sin_entrega_por_falta_de_informacion') OR $armado->estat == config('app.intento_de_entrega_fallido'))
    @can('logistica.pedidoActivo.armado.edit')
      <a href="{{ route('logistica.pedidoActivo.armado.edit', Crypt::encrypt($armado->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcan
  @endif
</td>



<td>
  @if($armado->estat == config('app.en_almacen_de_salida') OR $armado->estat == config('app.sin_entrega_por_falta_de_informacion') OR $armado->estat == config('app.intento_de_entrega_fallido'))
    @can('logistica.pedidoActivo.armado.edit')
      <div class="card">
        <div class="card-header p-0 m-0" id="h{{ $armado->id }}">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#a{{ $armado->id }}" aria-expanded="false" aria-controls="a{{ $armado->id }}">
            <strong><i class="fas fa-sign-out-alt"></i></strong>
          </button>
        </div>
        <div id="a{{ $armado->id }}" class="collapse" aria-labelledby="h{{ $armado->id }}">
          <div class="card-body p-1">
            {!! Form::open(['route' => ['logistica.pedidoActivo.armado.updateModal', Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'logisticaPedidoActivoArmadoUpdateModal'.$armado->id]) !!}
              <div class="modal-body">
                <div class="row">
                  <label for="ubicacion_rack">{{ __('Editar RACK') }}</label>
                </div>
                <div class="row">
                  <div class="form-group col-sm btn-sm" id="ubicacion-rack">
                    <div class="input-group">
                    
                      {!! Form::text('ubicacion_rack', $armado->ubic_rack	, ['class' => 'form-control' . ($errors->has('ubicacion_rack') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Ubic. rack')]) !!}
                    </div>
                    <span class="text-danger">{{ $errors->first('ubicacion_rack') }}</span>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" id="btnsubmit{{ $armado->id }}" class="btn btn-info W-100" onclick="return check('btnsubmit{{ $armado->id }}', 'logisticaPedidoActivoArmadoUpdateModal{{ $armado->id }}', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');">{{ __('Actualizar') }}</button>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    @endcan
  @endif
</td>
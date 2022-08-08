@canany(['almacen.pedidoActivo.index', 'almacen.pedidoActivo.show', 'almacen.pedidoActivo.edit'])
  <li class="nav-item">
    <a href="{{ route('almacen.pedidoActivo.index') }}" class="nav-link {{ Request::is('almacen/pedido-activo') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos activos') }}
    </a>
  </li>
@endcanany
@canany(['almacen.pedidoTerminado.index', 'almacen.pedidoTerminado.show'])
  <li class="nav-item">
    <a href="{{ route('almacen.pedidoTerminado.index') }}" class="nav-link {{ Request::is('almacen/pedido-terminado') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos terminados') }} (-90d)
    </a>
  </li>
@endcanany
@if(Request::route()->getName() == 'almacen.pedidoActivo.index')
  @can('almacen.pedidoActivo.index')
    <li class="nav-item ml-auto">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-file-excel"></i> {{ __('Generar reporte') }}
      </button>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          {!! Form::open(['route' => 'almacen.pedidoActivo.generarReporte']) !!}
            <div class="modal-content">
              <div class="modal-header p-1">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Generar reporte') }}</h5>
                <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="form-group col-sm btn-sm">
                    <label for="id_pedidos">{{ __('Seleccionar pedidos') }} *</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                      </div>
                      {!! Form::select('id_pedidos[]', $pedidos_plunk, null, ['class' => 'form-control select2' . ($errors->has('id_pedidos') ? ' is-invalid' : ''), 'multiple']) !!}
                    </div>
                    <span class="text-danger">{{ $errors->first('id_pedidos') }}</span>
                  </div>
                </div>
                @include('layouts.private.plugins.priv_plu_select2')
              </div>
              <div class="modal-footer p-1">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('Cerrar') }}</button>
                <button type="submit" id="btnsubmit3" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i> {{ __('Generar reporte') }}</button>
              </div>
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </li>
  @endcan
@endif
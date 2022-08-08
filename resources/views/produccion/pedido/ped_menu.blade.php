@canany(['produccion.pedidoActivo.index', 'produccion.pedidoActivo.show', 'produccion.pedidoActivo.edit'])
  <li class="nav-item">
    <a href="{{ route('produccion.pedidoActivo.index') }}" class="nav-link {{ Request::is('produccion/pedido-activo') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos activos') }}
    </a>
  </li>
@endcanany
@canany(['produccion.pedidoTerminado.index', 'produccion.pedidoTerminado.show'])
  <li class="nav-item">
    <a href="{{ route('produccion.pedidoTerminado.index') }}" class="nav-link {{ Request::is('produccion/pedido-terminado') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos terminados') }} (-90d)
    </a>
  </li>
@endcanany
<div class="col-sm-6"></div>
@if (Request::route()->getName() == 'produccion.pedidoActivo.index')
  @can('produccion.pedidoActivo.index')
    <li class="nav-item ml-auto">
      {!! Form::open(['route' => 'produccion.pedidoActivo.reporteProduccionExport', 'method' => 'get']) !!}
        <button type="submit" id="btnsubmit1" class="btn btn-dark btn-md"><i class="fas fa-file-excel"></i> {{ __('Generar reporte') }}</button>
      {!! Form::close() !!}
    </li>
  @endcan

  {{--  @canany(['produccion.pedidoActivo.index'])
    <li class="nav-item ml-auto">
      <a id="btn_not" class="btn btn-outline-danger" href="{{ route('produccion.pedido.notificacion.notifi') }}">
        <i class="fas fa-list nav-icon"></i> {{ __('Notificaciones') }}
      </a>
    </li>
  @endcanany  --}}
@endif

{{--  @section('css')
<style>
#btn_not {
  
  animation-name: parpadeo;
  animation-duration: 7s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 7s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
}

@-moz-keyframes parpadeo{  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

@-webkit-keyframes parpadeo {  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@keyframes parpadeo {  
  0% { opacity: 1.0; }
   50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}
</style>
@endsection  --}}
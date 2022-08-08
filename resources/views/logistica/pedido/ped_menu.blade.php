@canany(['logistica.pedidoActivo.index', 'logistica.pedidoActivo.show', 'logistica.pedidoActivo.edit'])
  <li class="nav-item">
    <a href="{{ route('logistica.pedidoActivo.index') }}" class="nav-link {{ Request::is('logistica/pedido-activo') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos activos') }}
    </a>
  </li>
@endcanany
@canany(['logistica.direccionLocal.index', 'logistica.direccionLocal.show', 'logistica.direccionLocal.create', 'logistica.direccionLocal.createEntrega'])
  <li class="nav-item">
    <a href="{{ route('logistica.direccionLocal.index') }}" class="nav-link {{ Request::is('logistica/direccion/local') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de direcciones locales') }}
    </a>
  </li>
@endcanany
@canany(['logistica.direccionForaneo.index', 'logistica.direccionForaneo.show', 'logistica.direccionForaneo.create', 'logistica.direccionForaneo.createEntrega',])
  <li class="nav-item">
    <a href="{{ route('logistica.direccionForaneo.index') }}" class="nav-link {{ Request::is('logistica/direccion/foraneo') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de direcciones foráneos') }}
    </a>
  </li>
@endcanany
@canany(['logistica.pedidoEntregado.index', 'logistica.pedidoEntregado.show'])
  <li class="nav-item">
    <a href="{{ route('logistica.pedidoEntregado.index') }}" class="nav-link {{ Request::is('logistica/pedido-entregado') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos entregados') }} (-90d)
    </a>
  </li>
@endcanany
@canany(['logistica.pedidoEntregado.index', 'logistica.pedidoEntregado.show', 'logistica.direccionEntregada.edit'])
  <li class="nav-item">
    <a href="{{ route('logistica.direccionEntregada.index') }}" class="nav-link {{ Request::is('logistica/direccion-entregada') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de direcciones entregadas') }} (-90d)
    </a>
  </li>
@endcanany
@include('logistica.pedido.ped_reportes')
@canany(['venta.pedidoActivo.index', 'venta.pedidoActivo.show', 'venta.pedidoActivo.edit', 'venta.pedidoActivo.destroy', 'venta.pedidoActivo.armado.show' ,'venta.pedidoActivo.armado.edit', 'venta.pedidoActivo.pago.create', 'venta.pedidoActivo.pago.show', 'venta.pedidoActivo.pago.edit'])
  <li class="nav-item">
    <a href="{{ route('venta.pedidoActivo.index') }}" class="nav-link {{ Request::is('venta/pedido-activo') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos activos') }}
    </a>
  </li>
@endcanany
@canany(['venta.pedidoTerminado.index', 'venta.pedidoTerminado.show'])
  <li class="nav-item">
    <a href="{{ route('venta.pedidoTerminado.index') }}" class="nav-link {{ Request::is('venta/pedido-terminado') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pedidos terminados') }}
    </a>
  </li>
@endcanany
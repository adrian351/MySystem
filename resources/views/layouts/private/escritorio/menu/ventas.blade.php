@canany(['venta.pedidoActivo.index', 'venta.pedidoActivo.show', 'venta.pedidoActivo.edit', 'venta.pedidoActivo.destroy', 'venta.pedidoActivo.armado.show' ,'venta.pedidoActivo.armado.edit', 'venta.pedidoActivo.pago.create', 'venta.pedidoActivo.pago.show', 'venta.pedidoActivo.pago.edit', 'venta.pedidoTerminado.index', 'venta.pedidoTerminado.show'])
<li class="nav-item has-treeview {{ Request::is('venta*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('venta*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-money-check-alt"></i>
      <p>
        {{ __('Ventas') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    @canany(['venta.pedidoActivo.index', 'venta.pedidoActivo.show', 'venta.pedidoActivo.edit', 'venta.pedidoActivo.destroy', 'venta.pedidoActivo.armado.show' ,'venta.pedidoActivo.armado.edit', 'venta.pedidoActivo.pago.create', 'venta.pedidoActivo.pago.show', 'venta.pedidoActivo.pago.edit', 'venta.pedidoTerminado.index', 'venta.pedidoTerminado.show'])
        <ul class="nav nav-treeview">
      {{--  <li class="nav-item">
          <a href="{{ route('venta.index') }}" class="nav-link {{ Request::is('inicio-ventas') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>{{ __('Inicio ventas') }}</p>
          </a>
        </li>  --}}
        <li class="nav-item has-treeview {{ Request::is('venta/pedido*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('venta/pedido*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>
              <p>{{ __('Pedidos') }}</p>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview ">
            @canany(['venta.pedidoActivo.index', 'venta.pedidoActivo.show', 'venta.pedidoActivo.edit', 'venta.pedidoActivo.destroy', 'venta.pedidoActivo.armado.show' ,'venta.pedidoActivo.armado.edit', 'venta.pedidoActivo.pago.create', 'venta.pedidoActivo.pago.show', 'venta.pedidoActivo.pago.edit'])
              <li class="nav-item">
                <a href="{{ route('venta.pedidoActivo.index') }}" class="nav-link {{ Request::is('venta/pedido-activo') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de pedidos activos') }}</p>
                </a>
              </li>
            @endcanany
            @canany(['venta.pedidoTerminado.index', 'venta.pedidoTerminado.show'])
              <li class="nav-item">
                <a href="{{ route('venta.pedidoTerminado.index') }}" class="nav-link {{ Request::is('venta/pedido-terminado') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de pedidos terminados') }}</p>
                </a>
              </li>
            @endcanany
          </ul>
        </li>
      </ul>
    @endcanany
  </li>
@endcanany
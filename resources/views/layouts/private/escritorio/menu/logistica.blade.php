@canany([
  'logistica.pedidoActivo.index', 'logistica.pedidoActivo.show', 'logistica.pedidoActivo.edit', 'logistica.pedidoActivo.armado.show', 'logistica.pedidoActivo.armado.edit',
  'logistica.direccionLocal.index', 'logistica.direccionLocal.show', 'logistica.direccionLocal.create', 'logistica.direccionLocal.createEntrega',
  'logistica.direccionForaneo.index', 'logistica.direccionForaneo.show', 'logistica.direccionForaneo.create', 'logistica.direccionForaneo.createEntrega',
  'logistica.pedidoEntregado.index','logistica.pedidoEntregado.show',
  'logistica.direccionLocal.edit', 'logistica.direccionForaneo.edit',
  'logistica.direccionEntregada.edit'
])
  <li class="nav-item has-treeview {{ Request::is('logistica*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('logistica*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-truck"></i>
      <p>
        {{ __('Logística') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      {{--  <li class="nav-item">
        <a href="{{ route('logistica.index') }}" class="nav-link {{ Request::is('inicio-logistica') ? 'active' : '' }}">
          <i class="nav-icon fas fa-home"></i>
          <p>{{ __('Inicio logística') }}</p>
        </a>
      </li>  --}}
      @canany(['logistica.pedidoActivo.index','logistica.pedidoActivo.show','logistica.pedidoActivo.edit', 'logistica.pedidoActivo.armado.show', 'logistica.pedidoActivo.armado.edit', 'logistica.direccionLocal.index', 'logistica.direccionLocal.show', 'logistica.direccionLocal.create', 'logistica.direccionLocal.createEntrega', 'logistica.direccionForaneo.index', 'logistica.direccionForaneo.show', 'logistica.direccionForaneo.create', 'logistica.direccionForaneo.createEntrega', 'logistica.pedidoEntregado.index','logistica.pedidoEntregado.show', 'logistica.direccionLocal.edit', 'logistica.direccionForaneo.edit', 'logistica.direccionEntregada.edit'])
        <li class="nav-item has-treeview {{ Request::is('logistica/pedido*') ? 'menu-open' : '' }} {{ Request::is('logistica/direccion*') ? 'menu-open' : '' }} ">
          <a href="#" class="nav-link {{ Request::is('logistica/pedido*') ? 'active' : '' }} {{ Request::is('logistica/direccion*') ? 'menu-open' : '' }}">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>
              <p>{{ __('Pedidos') }}</p>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @canany(['logistica.pedidoActivo.index','logistica.pedidoActivo.show','logistica.pedidoActivo.edit', 'logistica.pedidoActivo.armado.show', 'logistica.pedidoActivo.armado.edit'])
              <li class="nav-item">
                <a href="{{ route('logistica.pedidoActivo.index') }}" class="nav-link {{ Request::is('logistica/pedido-activo') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de pedidos activos') }}</p>
                </a>
              </li>
            @endcanany
            @canany(['logistica.direccionLocal.index', 'logistica.direccionLocal.show', 'logistica.direccionLocal.create', 'logistica.direccionLocal.createEntrega', 'logistica.direccionLocal.edit'])
              <li class="nav-item">
                <a href="{{ route('logistica.direccionLocal.index') }}" class="nav-link {{ Request::is('logistica/direccion/local') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de direcciones locales') }}</p>
                </a>
              </li>
            @endcanany
            @canany(['logistica.direccionForaneo.index', 'logistica.direccionForaneo.show', 'logistica.direccionForaneo.create', 'logistica.direccionForaneo.createEntrega', 'logistica.direccionForaneo.edit'])
              <li class="nav-item">
                <a href="{{ route('logistica.direccionForaneo.index') }}" class="nav-link {{ Request::is('logistica/direccion/foraneo') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de direcciones foráneos') }}</p>
                </a>
              </li>
            @endcanany
            @canany(['logistica.pedidoEntregado.index', 'logistica.pedidoEntregado.show'])
              <li class="nav-item">
                <a href="{{ route('logistica.pedidoEntregado.index') }}" class="nav-link {{ Request::is('logistica/pedido-entregado') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de pedidos entregados') }}</p>
                </a>
              </li>
            @endcanany
            @canany(['logistica.pedidoEntregado.index', 'logistica.pedidoEntregado.show', 'logistica.direccionEntregada.edit'])
            <li class="nav-item">
              <a href="{{ route('logistica.direccionEntregada.index') }}" class="nav-link {{ Request::is('logistica/direccion-entregada') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                <p>{{ __('Lista de direcciones entregadas') }}</p>
              </a>
            </li>
          @endcanany
          </ul>
        </li>
      @endcanany
    </ul>
  </li>
@endcanany
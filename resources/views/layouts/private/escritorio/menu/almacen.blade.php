@canany([
  'almacen.producto.index', 'almacen.producto.create', 'almacen.producto.show', 'almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.destroy', 'almacen.producto.editValidado', 'almacen.producto.editHabilitado', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.edit', 'almacen.producto.proveedor.destroy',
  'almacen.pedidoActivo.index', 'almacen.pedidoActivo.show', 'almacen.pedidoActivo.edit', 'almacen.pedidoActivo.armado.show', 'almacen.pedidoActivo.armado.edit',
  'almacen.pedidoTerminado.index','almacen.pedidoTerminado.show'
])
  <li class="nav-item has-treeview {{ Request::is('almacen*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('almacen*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-warehouse"></i>
      <p>
        {{ __('Almacén') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      {{--  <li class="nav-item">
        <a href="{{ route('almacen.index') }}" class="nav-link {{ Request::is('inicio-almacen') ? 'active' : '' }}">
          <i class="nav-icon fas fa-home"></i>
          <p>{{ __('Inicio almacén') }}</p>
        </a>
      </li>  --}}
      @canany(['almacen.pedidoActivo.index','almacen.pedidoActivo.show','almacen.pedidoActivo.edit', 'almacen.pedidoActivo.armado.show', 'almacen.pedidoActivo.armado.edit', 'almacen.pedidoTerminado.index','almacen.pedidoTerminado.show'])
        <li class="nav-item has-treeview {{ Request::is('almacen/pedido*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('almacen/pedido*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>
              <p>{{ __('Pedidos') }}</p>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview ">
            @canany(['almacen.pedidoActivo.index','almacen.pedidoActivo.show','almacen.pedidoActivo.edit', 'almacen.pedidoActivo.armado.show', 'almacen.pedidoActivo.armado.edit'])
              <li class="nav-item">
                <a href="{{ route('almacen.pedidoActivo.index') }}" class="nav-link {{ Request::is('almacen/pedido-activo') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de pedidos activos') }}</p>
                </a>
              </li>
            @endcanany
            @canany(['almacen.pedidoTerminado.index', 'almacen.pedidoTerminado.show'])
              <li class="nav-item">
                <a href="{{ route('almacen.pedidoTerminado.index') }}" class="nav-link {{ Request::is('almacen/pedido-terminado') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de pedidos terminados') }}</p>
                </a>
              </li>
            @endcanany
          </ul>
        </li>
      @endcanany
    </ul>
    @canany(['almacen.producto.index', 'almacen.producto.create', 'almacen.producto.show', 'almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.destroy', 'almacen.producto.editValidado', 'almacen.producto.editHabilitado', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.edit', 'almacen.producto.proveedor.destroy'])
      <ul class="nav nav-treeview">
        <li class="nav-item has-treeview {{ Request::is('almacen/producto*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('almacen/producto*') ? 'active' : '' }}">
            <i class="nav-icon fab fa-product-hunt"></i>
            <p>
              <p>{{ __('Productos') }}</p>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview ">
            @canany(['almacen.producto.index', 'almacen.producto.create', 'almacen.producto.show', 'almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.destroy', 'almacen.producto.editValidado', 'almacen.producto.editHabilitado', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.edit', 'almacen.producto.proveedor.destroy'])
              <li class="nav-item">
                <a href="{{ route('almacen.producto.index') }}" class="nav-link {{ Request::is('almacen/producto') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de productos') }}</p>
                </a>
              </li>
            @endcanany
            @can('almacen.producto.create')
              <li class="nav-item">
                <a href="{{ route('almacen.producto.create') }}" class="nav-link {{ Request::is('almacen/producto/crear') ? 'active' : '' }}">
                  <i class="nav-icon far fa-plus-square"></i>
                  <p>{{ __('Registrar producto') }}</p>
                </a>
              </li>
            @endcan
          </ul>
        </li>
      </ul>
    @endcanany

    <ul class="nav nav-treeview">
      @canany(['almacen.nota.index', 'almacen.nota.create', 'almacen.nota.show', 'almacen.nota.edit'])
        <li class="nav-item ">
          <a href="{{ route('almacen.nota.index') }}" class="nav-link {{ Request::is('almacen/nota') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Notas de remisión') }}</p>
          </a>
        </li>
      @endcanany
    </ul>
  </li>
@endcanany
@canany(['factura.index', 'factura.create', 'factura.show', 'factura.edit', 'factura.destroy'])
  <li class="nav-item has-treeview {{ Request::is('factura*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('factura*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-file-invoice"></i>
      <p>
        {{ __('Facturación') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['factura.index', 'factura.create', 'factura.show', 'factura.edit', 'factura.destroy'])
        <li class="nav-item">
          <a href="{{ route('factura.index') }}" class="nav-link {{ Request::is('factura') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de facturas') }}</p>
          </a>
        </li>
      @endcanany
      @can('factura.create')
        <li class="nav-item">
          <a href="{{ route('factura.create') }}" class="nav-link {{ Request::is('factura/solicitar') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Solicitar factura') }}</p>
          </a>
        </li>
      @endcan
    </ul>
  </li>
@endcanany
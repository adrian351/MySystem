@canany(['cotizacion.index', 'cotizacion.create', 'cotizacion.show', 'cotizacion.edit', 'cotizacion.destroy'])
  <li class="nav-item has-treeview {{ Request::is('cotizacion*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('cotizacion*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-folder-minus"></i>
      <p>
        {{ __('Cotizaciones') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['cotizacion.index', 'cotizacion.create', 'cotizacion.show', 'cotizacion.edit', 'cotizacion.destroy'])
        <li class="nav-item">
          <a href="{{ route('cotizacion.index') }}" class="nav-link {{ Request::is('cotizacion') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de cotizaciones') }}</p>
          </a>
        </li>
      @endcanany
      @can('cotizacion.create')
        <li class="nav-item">
          <a href="{{ route('cotizacion.create') }}" class="nav-link {{ Request::is('cotizacion/crear') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Crear cotización') }}</p>
          </a>
        </li>
      @endcan
    </ul>
  </li>
@endcanany
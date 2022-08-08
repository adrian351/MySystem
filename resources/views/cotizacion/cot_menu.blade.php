@canany(['cotizacion.index', 'cotizacion.create', 'cotizacion.show', 'cotizacion.edit', 'cotizacion.destroy'])
  <li class="nav-item">
    <a href="{{ route('cotizacion.index') }}" class="nav-link {{ Request::is('cotizacion') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de cotizaciones') }}
    </a>
  </li>
@endcanany
@can('cotizacion.create')
  <li class="nav-item">
    <a href="{{ route('cotizacion.create') }}" class="nav-link {{ Request::is('cotizacion/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Crear cotización') }}
    </a>
  </li>
@endcan
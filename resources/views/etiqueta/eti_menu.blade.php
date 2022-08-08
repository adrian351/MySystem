@canany(['etiqueta.index', 'etiqueta.create', 'etiqueta.edit', 'etiqueta.destroy'])
  <li class="nav-item">
    <a href="{{ route('etiqueta.index') }}" class="nav-link {{ Request::is('etiqueta') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de etiquetas') }}
    </a>
  </li>
@endcanany
@can('etiqueta.create')
  <li class="nav-item">
    <a href="{{ route('etiqueta.create') }}" class="nav-link {{ Request::is('etiqueta/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar etiqueta') }}
    </a>
  </li>
@endcan
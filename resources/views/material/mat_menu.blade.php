@canany(['material.index', 'material.create', 'material.show', 'material.edit', 'material.destroy'])
  <li class="nav-item">
    <a href="{{ route('material.index') }}" class="nav-link {{ Request::is('material') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de materiales') }}
    </a>
  </li>
@endcanany
@can('material.create')
  <li class="nav-item">
    <a href="{{ route('material.create') }}" class="nav-link {{ Request::is('material/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar material') }}
    </a>
  </li>
@endcan
@can('material.consultarPrecio')
  <li class="nav-item">
    <a href="{{ route('material.consultarPrecio') }}" class="nav-link {{ Request::is('material/consultar-precio') ? 'active' : '' }}">
      <i class="fas fa-search"></i> {{ __('Consultar precio') }}
    </a>
  </li>
@endcan
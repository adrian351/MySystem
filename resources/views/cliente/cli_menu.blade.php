@canany(['cliente.index', 'cliente.create', 'cliente.show', 'cliente.edit', 'cliente.destroy'])
  <li class="nav-item">
    <a href="{{ route('cliente.index') }}" class="nav-link {{ Request::is('cliente') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de clientes') }}
    </a>
  </li>
@endcanany
@can('cliente.create')
  <li class="nav-item">
    <a href="{{ route('cliente.create') }}" class="nav-link {{ Request::is('cliente/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar cliente') }}
    </a>
  </li>
@endcan
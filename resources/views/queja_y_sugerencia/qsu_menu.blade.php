@can('qys.index', )
  <li class="nav-item">
    <a href="{{ route('qys.index') }}" class="nav-link {{ Request::is('qys') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de quejas y sugerencias') }}
    </a>
  </li>
@endcan
@can('qys.create')
  <li class="nav-item">
    <a href="{{ route('qys.create') }}" class="nav-link {{ Request::is('qys/registrar') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar') }}
    </a>
  </li>
@endcan